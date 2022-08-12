<?php	
/**
*	"Black Min" 
*	
*	For the full copyright and license information, please view the LICENSE
*	file that was distributed with this source code.
*
*	@package BlackMin
*	
*	#plik: 2.0
*
*	This file is (FileSystem) for BlackMin [only bm]
*/

    namespace BlackMin\FileSystem;

    final class FileSystemBM {

        /**
         *  
         */

        private $path;
        
        /**
         *  @var string;
         */

        private $type;

        /**
         * @var array
         */

        private $error = [];

        /**
         * @var array 
         */
        private $data;

        function __construct(string $path = "", string $type = "dir") {
            $this->setPath($path);
        }

        public function setPath (string $path) {
            $this->path = str_replace("/", DIRECTORY_SEPARATOR, (strlen($path) === 0 ? "../../../" : $this->getRelativePath("../../../",  $path)));
        }
        
        public function setType (string $type) {
            $this->type = $type;
        }

        public function getPath():string {
            return (string) $this->path;
        }

        public function getType():string {
            return (string) $this->type;
        }

        // funkcja skanująca dane w systemie plików po glob
        public function glob (string $pattern = "", string $path = "", bool $all = false, bool $onlyPath = true, int $flags = 0):bool|array {
            try {
                // cache array scan directory
                $cache = [];

                // scan directory path
                $glob = glob(($path === '' ? $this->path : $path) . $pattern, $flags | GLOB_MARK);

                if (!$glob) {
                    $this->addError("FSBM: Wystąpił bład pod czas pobierania wgranych plików!");
                }

                foreach ($glob as $value) {
                    if (!in_array($value, [".", ".."])) {
                        if (is_dir($value)) {
                            $children = ($all === true ? $this->scan((string) $pattern, (string) $value, (bool) $all, (bool) $onlyPath, (int) $flags) : null);
                            $type = "dir";
                            $file_extension = null;
                        }else{
                            $children = null;
                            $type = "file";
                            $exp = explode(".", $value);
                            $file_extension = $exp[count($exp)-1];
                        }

                        if ($children === false) {
                            $this->addError("FSBM: Wystąpił błąd z ścieżką do pliku!");
                            break;
                        }

                        $value_exp = explode(DIRECTORY_SEPARATOR, $value);
                        $value_exp_count = count($value_exp);

                        // set info scan
                        $infoScan = [
                            "name" => ($type === "file" ? ($value_exp[$value_exp_count-1]) : ($value_exp[$value_exp_count-2])),
                            "path" => $value,
                            "parent" => ($value_exp[$value_exp_count-2]),
                            "type" => $type,
                            "file_extension" => $file_extension
                        ];
                        if ($onlyPath === false) {
                            $infoScan["children"] = $children;
                        }

                        array_push($cache, $infoScan);

                        if ($onlyPath === true) {
                            foreach ((array) $children as $key => $value) {
                                if (!is_null($value)) {
                                    $cache[] = $value;
                                }
                            }
                        }
                    }
                }

                $this->data = $cache;

                return $cache;
            } catch (\Throwable $th) {
                throw $this->addError($th);
                return false;
            }
        }
        
        // funkcja skanująca dane w systemie plików
        public function scan (string $pattern = "", string $path = "", int $all = -1, bool $onlyPath = true, int $flags = 0):bool|array {
            try {
                // cache array scan directory
                $cache = [];
                $dir = false;

                // scan directory path
                $glob = @glob(($path === '' ? $this->path : $path) . $pattern, $flags | GLOB_MARK);

                if (count($glob) === 0) {
                    $glob = glob(($path === '' ? $this->path : $path) . "*", GLOB_MARK|GLOB_ONLYDIR);
                    $dir = true;
                }

                // subtraction of the numerator
                $all--;
                
                foreach ($glob as $value) {
                    if (!in_array($value, [".", ".."])) {
                        if (is_dir($value)) {
                            
                            $children = (((($all === -1) || ($all !== 0)) && ($all >= -1)) ? $this->scan((string) $pattern, (string) $value, (int) $all, (bool) $onlyPath, (int) $flags) : null);
                            $type = "dir";
                            $file_extension = null;
                        }else{
                            $children = null;
                            $type = "file";
                            $exp = explode(".", $value);
                            $file_extension = $exp[count($exp)-1];
                        }

                        if ($children === false) {
                            $this->addError("FSBM: Wystąpił błąd z ścieżką do pliku!");
                            break;
                        }

                        $value_exp = explode(DIRECTORY_SEPARATOR, $value);
                        $value_exp_count = count($value_exp);

                        // set info scan
                        $infoScan = [
                            "name" => ($type === "file" ? ($value_exp[$value_exp_count-1]) : ($value_exp[$value_exp_count-2])),
                            "path" => $value,
                            "parent" => ($value_exp[$value_exp_count-2]),
                            "type" => $type,
                            "file_extension" => $file_extension
                        ];
                        if ($onlyPath === false) {
                            $infoScan["children"] = $children;
                        }

                        if (!$dir || !$onlyPath) {
                            array_push($cache, $infoScan);
                        }

                        if ($onlyPath === true) {
                            foreach ((array) $children as $key => $value) {
                                if (!is_null($value)) {
                                    $cache[] = $value;
                                }
                            }
                        }
                    }
                }

                $this->data = $cache;

                return $cache;
            } catch (\Throwable $th) {
                throw $this->addError($th);
                return false;
            }
        }

        // function scan all directory
        public function scanAll(string $path, bool $all = false, bool $onlyPath = true, int $sorting_order = SCANDIR_SORT_ASCENDING):bool|array {
            try {
                // cache array scan directory
                $cache = [];

                // check is a dir
                if (!is_dir($this->path . $path)) {
                    $this->addError("FSBM: Podana śćieżka nie jest folderem!");
                    return false;
                }
                // scan directory path
                $scandir = scandir($this->path . $path, $sorting_order);

                foreach ($scandir as $key => $value) {
                    if (!in_array($value, [".", ".."])) {
                        if (is_dir($this->path . $path . $value . DIRECTORY_SEPARATOR)) {
                            $children = ($all === true ? $this->scanAll($path . $value . DIRECTORY_SEPARATOR, $all, $onlyPath, $sorting_order) : null);
                            $path_orginal = $this->path . $path . $value . DIRECTORY_SEPARATOR;
                            $type = "dir";
                            $file_extension = null;
                        }else{
                            $children = null;
                            $path_orginal = $this->path . $path . $value;
                            $type = "file";
                            $exp = explode(".", $value);
                            $file_extension = $exp[count($exp)-1];
                        }

                        if ($children === false) {
                            $this->addError("FSBM: Wystąpił błąd z ścieżką do pliku!");
                            return false;
                            break;
                        }

                        // set info scan
                        $infoScan = [
                            "name" => $value,
                            "path" => $path_orginal,
                            "parent" => $this->path . $path,
                            "type" => $type,
                            "file_extension" => $file_extension
                        ];
                        if ($onlyPath === false) {
                            $infoScan["children"] = $children;
                        }

                        array_push($cache, $infoScan);

                        if ($onlyPath === true) {
                            foreach ((array) $children as $key => $value) {
                                if (!is_null($value)) {
                                    $cache[] = $value;
                                }
                            }
                        }
                    }
                }

                $this->data = $cache;

                return $cache;
            } catch (\Throwable $th) {
                throw $this->addError($th);
                return false;
            }
        }

        // funkcja skanująca katalogi
        public function scanDir(string $path, bool $all = false, bool $onlyPath = true, int $sorting_order = SCANDIR_SORT_ASCENDING):bool|array {
            try {
                // cache array scan directory
                $cache = [];

                // check is a dir
                if (!is_dir($this->path . $path)) {
                    $this->addError("FSBM: Podana śćieżka nie jest folderem!");
                    return false;
                }
                // scan directory path
                $scandir = scandir($this->path . $path, $sorting_order);

                foreach ($scandir as $key => $value) {
                    if (!in_array($value, [".", ".."])) {
                        if (is_dir($this->path . $path . $value . DIRECTORY_SEPARATOR)) {
                            $children = ($all === true ? $this->scanDir($path . $value . DIRECTORY_SEPARATOR, $all, $onlyPath, $sorting_order) : null);
                            $path_orginal = $this->path . $path . $value . DIRECTORY_SEPARATOR;
                            $type = "dir";

                            if ($children === false) {
                                $this->addError("FSBM: Wystąpił błąd z ścieżką do pliku!");
                                return false;
                                break;
                            }

                            // set info scan
                            $infoScan = [
                                "name" => $value,
                                "path" => $path_orginal,
                                "parent" => $this->path . $path,
                                "type" => $type
                            ];
                            if ($onlyPath === false) {
                                $infoScan["children"] = $children;
                            }

                            array_push($cache, $infoScan);

                            if ($onlyPath === true) {
                                foreach ((array) $children as $key => $value) {
                                    if (!is_null($value)) {
                                        $cache[] = $value;
                                    }
                                }
                            }
                        }
                    }
                }

                $this->data = $cache;

                return $cache;
            } catch (\Throwable $th) {
                throw $this->addError($th);
                return false;
            }
        }
        
        // funkcja skanująca file
        public function scanFile(string $path, bool $all = false, bool $onlyPath = true, int $sorting_order = SCANDIR_SORT_ASCENDING):bool|array {
            try {
                // cache array scan directory
                $cache = [];

                // check is a dir
                if (!is_dir($this->path . $path)) {
                    $this->addError("FSBM: Podana śćieżka nie jest folderem!");
                    return false;
                }
                // scan directory path
                $scandir = scandir($this->path . $path, $sorting_order);

                foreach ($scandir as $key => $value) {
                    if (!in_array($value, [".", ".."])) {
                        $is_dir = is_dir($this->path . $path . $value . DIRECTORY_SEPARATOR);
                        if ($is_dir) {
                            // multi scan
                            $children = ($all === true ? $this->scanFile($path . $value . DIRECTORY_SEPARATOR, $all, $onlyPath, $sorting_order) : null);
                            $path_orginal = $this->path . $path . $value . DIRECTORY_SEPARATOR;
                            $type = "dir";
                            $file_extension = null;
                        }else{
                            $children = null;
                            $path_orginal = $this->path . $path . $value;
                            $type = "file";
                            $exp = explode(".", $value);
                            $file_extension = $exp[count($exp)-1];
                        }

                        if ($children === false) {
                            $this->addError("FSBM: Wystąpił błąd z ścieżką do pliku!");
                            return false;
                            break;
                        }

                        // set info scan
                        $infoScan = [
                            "name" => $value,
                            "path" => $path_orginal,
                            "parent" => $this->path . $path,
                            "type" => $type,
                            "file_extension" => $file_extension
                        ];
                        if ($onlyPath === false) {
                            $infoScan["children"] = $children;
                            // add element to cache
                            array_push($cache, $infoScan);
                        } else {
                            if (!$is_dir) {
                                // add element to cache
                                array_push($cache, $infoScan);
                            }
                            foreach ((array) $children as $key => $value) {
                                if (!is_null($value)) {
                                    $cache[] = $value;
                                }
                            }
                        }
                    }
                }

                $this->data = $cache;

                return $cache;
            } catch (\Throwable $th) {
                throw $this->addError($th);
                return false;
            }
        }

        // this function is getting data
        public function get() {
            return $this->data;
        }

        // function remove all file in directory
        public function remove(string $path, bool $all = false, bool $delParent = true, bool $empty = false):bool {
            // check try error
            try {
                // check is a dir
                if (!is_dir($this->path . $path)) {
                    $this->addError("FSBM: Podana śćieżka nie jest folderem!");
                    return false;
                }
                
                // check all is true
                if ($all) {
                     // use removeDirectory and check error
                    if (!$this->removeDirectory($path, $delParent, $empty)) {
                        return false;
                    }
                } else {
                    // remove file in directory use removeFile and check error
                    if (!$this->removeFile($path)) {
                        return false;
                    }

                    // check directory is empty use isEmpty and check error
                    if ($this->isEmpty($path)) {
                        // remove directory use rmdir and check error
                        if (!rmdir($path)) {
                            return false;
                        }
                    }
                }

                return true;
            } catch (\Throwable $th) {
                throw $this->addError($th);
                return false;
            }
        }

        // function remove directory
        public function removeDirectory(string|array $path, bool $delParent = true, bool $empty = false):bool {
            // check try error and remove directory and return info to empty directory
            try {
                // check path is string
                if (is_string($path)) {
                    if (!is_dir($this->path . $path)) {
                        $this->addError("FSBM: Podana śćieżka nie jest folderem!");
                        return false;
                    }
    
                    // scan directory path use function scanDir
                    $scanDir = $this->scanDir($path, true, false, SCANDIR_SORT_ASCENDING);

                    // check scndir is false
                    if ($scanDir === false) {
                        $this->addError("FSBM: Wystąpił błąd z ścieżką do folderu!");
                        return false;
                    }
                } else {
                    $scanDir = $path;
                }

                // check scanDir is empty and remove this directory
                if (count($scanDir) !== 0) {
                    foreach ($scanDir as $key => $value) {
                        // check this directory is empty use isEmpty and check error
                        if (!$this->isEmpty($value["path"], true)) {
                            // remove file in directory use removeFile and check error
                            if (!$this->removeFile(str_replace($this->path, "", $value["path"]))) {
                                return false;
                            }
                        }

                        // if this directory has children repeat this function with this directory and check error
                        if (($value["type"] === "dir") && ($value["children"] !== null) && (count($value["children"]) !== 0)) {
                            if (!$this->removeDirectory($value["children"], $delParent, $empty)) {
                                return false;
                            }
                        }

                        // check is dir
                        if ($value["type"] === "dir") {
                             // check delParent is true
                            if ($delParent) {
                                if (!rmdir($value["path"])) {
                                    $this->addError("FSBM: Wystąpił błąd pod czas usuwania folderu!");
                                    return false;
                                }
                            }
                        }
                    }       
                             
                } else {
                    // check delParent is true
                    if ($delParent) {
                        if (!rmdir($this->path . $path)) {
                            $this->addError("FSBM: Wystąpił błąd pod czas usuwania folderu!");
                            return false;
                        }
                    }
                }

                // check path is string
                if (is_string($path)) {
                    // check this directory is empty use isEmpty and check error
                    if (!$this->isEmpty($path)) {
                        // remove file in directory use removeFile and check error
                        if (!$this->removeFile($path)) {
                            return false;
                        }
                    }

                    $tempPath = $this->path . $path;
                } else {
                    $tempPath = $path[0]["parent"];
                }

                // check empty is true
                if ($empty === true) {
                    // check delParent is true
                    if ($delParent === true) {
                        if ($this->isEmpty($tempPath, true)) {
                            if (!rmdir($tempPath)) {
                                $this->addError("FSBM: Wystąpił błąd pod czas usuwania folderu!");
                                return false;
                            }
                        }
                    }
                } else {
                    // check delParent is true
                    if ($delParent === true) {
                        if (!$this->isEmpty($tempPath, true)) {
                            return false;
                        }

                        if (!rmdir($tempPath)) {
                            $this->addError("FSBM: Wystąpił błąd pod czas usuwania folderu!");
                            return false;
                        }
                    }
                }

                return true;
            } catch (\Throwable $th) {
                throw $this->addError($th);
                return false;
            }
        }

        // function remove file
        public function removeFile(string|array $path = ""): bool {
            // check try error and delete file in directory
            try {
                $scanfile = false;
                // check path is string and array
                if (is_string($path)) {
                    if (is_file($this->path . $path)) {
                        $scanfile = [$path];
                    }
                }else if (is_array($path)) {
                    if (is_file($this->path . $path[0])) {
                        $scanfile = $path;
                    }
                }
                
                if ($scanfile !== false) {
                    foreach ($scanfile as $key => $value) {
                        if (!unlink($this->path . $value)) {
                            $this->addError("FSBM: Wystąpił błąd podczas usuwania pliku!");
                            return false;
                            break;
                        }
                    }
                    return true;
                }

                // if path is string use function scanFile else use array path
                if (is_string($path) && (!is_array($path))) {
                    // check is a dir
                    if (!$this->isExistDir($this->path . $path, true)) {
                        $this->addError("FSBM: Podana śćieżka nie jest folderem!");
                        return false;
                    }

                    // scan directory file path
                    $scanfile = $this->scanFile($path, false, true, SCANDIR_SORT_ASCENDING);
                } else {
                    $scanfile = $path;
                }

                if ($scanfile === false) {
                    return false;
                }
                foreach ($scanfile as $key => $value) {
                    if (!is_null($value)) {
                        if (($value["type"] === "file") && ($this->isExistFile($value["path"], true))) {
                            if (!unlink($value["path"])) {
                                $this->addError("FSBM: Wystąpił błąd podczas usuwania pliku!");
                                return false;
                            }
                        }
                    }
                }
                return true;
            } catch (\Throwable $th) {
                throw $this->addError($th);
                return false;
            }
        }

        // this function change hmod in directory (only)
        public function chmod(string $path = "", int $chmod = 0755): bool {
            // check try error
            try {
                // change hmod
                if (!chmod($this->path . $path, $chmod)) {
                    $this->addError("FSBM: Wystąpił błąd podczas zmiany uprawnień!");
                    return false;
                }
                return true;
            } catch (\Throwable $th) {
                throw $this->addError($th);
                return false;
            }
        }

        // this function is coppy all 
        public function copy() {
            # code...
        }

        // this function is save file in directory
        public function saveFile(string $path = "", string $file = "", string $content = "", bool $replace = true, int $flag = 0): bool {
            // check try error
            try {
                // check path is string
                if (is_string($path)) {
                    // check is a dir
                    if (!$this->isExistDir($this->path . $path, true)) {
                        $this->addError("FSBM: Podana śćieżka nie jest folderem!");
                        return false;
                    }
                }
                
                // check replace file
                if (!$replace) {
                    // check file is string
                    if (is_string($file)) {
                        // check file is exist
                        if ($this->isExistFile($this->path . $path . $file, true)) {
                            $this->addError("FSBM: Plik o podanej nazwie już istnieje!");
                            return false;
                        }
                    }
                }
                
                // check content is string
                if (is_string($content)) {
                    // save file
                    if (!file_put_contents($this->path . $path . $file, $content, $flag)) {
                        $this->addError("FSBM: Wystąpił błąd podczas zapisu pliku!");
                        return false;
                    }
                }
                return true;
            } catch (\Throwable $th) {
                throw $this->addError($th);
                return false;
            }
        }

        // this function is crate directory in directory
        public function createDir(string $path = "", string $dir = "", int $permissions = 0755): bool {
            // check try error
            try {
                // check is a dir
                if (!$this->isExistDir($path)) {
                    $this->addError("FSBM: Podana śćieżka nie jest folderem!");
                    return false;
                }

                // check dir is string
                if (!is_string($dir)) {
                    $this->addError("FSBM: Podana nazwa folderu nie jest poprawna!");
                    return false;
                }

                // check permissions is int
                if (!is_int($permissions)) {
                    $this->addError("FSBM: Uprawnienia do folderu nie są liczba!");
                    return false;
                }

                // check dir is exist
                if (!$this->isExistDir($path . $dir, false)) {
                    // create directory
                    if (!mkdir($this->path . $path . $dir, $permissions, true)) {
                        $this->addError("FSBM: Wystąpił błąd podczas tworzenia folderu!");
                        return false;
                    }
                }

                return true;
            } catch (\Throwable $th) {
                throw $this->addError($th);
                return false;
            }
        }

        // this function is create strucurture directory
        public function createStructure(string $path = "", int $permissions = 755, string $year = "Y", string $month = "m", string $day = "null", bool $time = false): bool|array {
            // check try error
            try {
                // check path is string
                if (is_string($path)) {
                    // check is a dir
                    if (!$this->isExistDir($path)) {
                        $this->addError("FSBM: Podana śćieżka nie jest folderem!");
                        return false;
                    }
                }
                
                // check year not null
                if ($year !== "null") {
                    // set year 
                    if (is_string($year)) {
                        $year = date($year);
                    }

                    // checkdate year
                    if (!checkdate(1, 1, $year)) {
                        $this->addError("FSBM: Podany rok nie jest poprawny!");
                        return false;
                    }
                }

                // check month not null
                if ($month !== "null") {
                    // set month
                    if (is_string($month)) {
                        $month = date($month);
                    }

                    // checkmonth month
                    if (!checkdate($month, 1, $year)) {
                        $this->addError("FSBM: Podany miesiąc nie jest poprawny!");
                        return false;
                    }
                }

                // check day not null
                if ($day !== "null") {
                    // set day
                    if (is_string($day)) {
                        $day = date($day);
                    }

                    // checkday day
                    if (!checkdate($month, $day, $year)) {
                        $this->addError("FSBM: Podany dzień nie jest poprawny!");
                        return false;
                    }
                }

                // check mktime is bool and set mktime
                if ($time) {
                    $time = time();
                }

                $paths = $year . DIRECTORY_SEPARATOR;
                $pathsT = $year . "_miniaturs" . DIRECTORY_SEPARATOR;

                // check year not null
                if ($year !== "null") {
                    // crate folder with year
                    if (!$this->createDir($path, $paths, $permissions)) {
                        $this->addError("FSBM: Wystąpił błąd podczas tworzenia folderu!");
                        return false;
                    }
                }

                // check month not null
                if ($month !== "null") {
                    // crate folder with month
                    if (!$this->createDir($path . $paths, $month . DIRECTORY_SEPARATOR, $permissions)) {
                        $this->addError("FSBM: Wystąpił błąd podczas tworzenia folderu!");
                        return false;
                    }
                    $paths .=  $month . DIRECTORY_SEPARATOR; 
                    $pathsT .=  $month . DIRECTORY_SEPARATOR; 
                }

                // check day not null
                if ($day !== "null") {
                    // crate folder with day
                    if (!$this->createDir($path . $paths, $day . DIRECTORY_SEPARATOR, $permissions)) {
                        $this->addError("FSBM: Wystąpił błąd podczas tworzenia folderu!");
                        return false;
                    }
                    $paths .=  $day . DIRECTORY_SEPARATOR;
                    $pathsT .=  $day . DIRECTORY_SEPARATOR;
                }
                
                // @miniaturs

                // check year not null
                if ($year !== "null") {
                    // crate folder with year
                    if (!$this->createDir($path, $year . "_miniaturs" . DIRECTORY_SEPARATOR, $permissions)) {
                        $this->addError("FSBM: Wystąpił błąd podczas tworzenia folderu!");
                        return false;
                    }
                }

                // check month not null
                if ($month !== "null") {
                    // crate folder with month
                    if (!$this->createDir($path . $year . "_miniaturs" . DIRECTORY_SEPARATOR, $month . DIRECTORY_SEPARATOR, $permissions)) {
                        $this->addError("FSBM: Wystąpił błąd podczas tworzenia folderu!");
                        return false;
                    }
                }

                // check day not null
                if ($day !== "null") {
                    // crate folder with day
                    if (!$this->createDir($path . $year . "_miniaturs" . DIRECTORY_SEPARATOR . $month . DIRECTORY_SEPARATOR, $day . DIRECTORY_SEPARATOR, $permissions)) {
                        $this->addError("FSBM: Wystąpił błąd podczas tworzenia folderu!");
                        return false;
                    }
                }

                return [$paths, $pathsT];
            } catch (\Throwable $th) {
                throw $this->addError($th);
                return false;
            }
        }

        // this function is alias for createStructure
        public function createThumbnail(string $path, string $file, string $name, int $width = 250, int $height = 170, int $quality = 100):bool|null {
            return $this->createMiniaturs($path, $file, $name, $width, $height, $quality);
        }

        // this function is create file miniaturs
        public function createMiniaturs(string $path, string $file, string $name, int $width = 250, int $height = 170, int $quality = 100): bool|null {
            // check try error
            try {
                // check path is string
                if (is_string($path)) {
                    // check is a dir
                    if (!$this->isExistDir($path)) {
                        $this->addError("FSBM: Podana śćieżka nie jest folderem!");
                        return false;
                    }
                }
                
                // check file is exist
                if (!$this->isExistFile($file, true)) {
                    $this->addError("FSBM: Podany plik nie istnieje!");
                    return false;
                }

                // check save path is empty
                if ($this->isExistFile($path . $name)) {
                    $this->addError("FSBM: Miniaturka już istnieje!");
                    return true;
                }
                
                // check width is int
                if (!is_int($width)) {
                    $this->addError("FSBM: Podana szerokość nie jest liczbą!");
                    return false;
                }
                
                // check height is int
                if (!is_int($height)) {
                    $this->addError("FSBM: Podana wysokość nie jest liczbą!");
                    return false;
                }
                
                // check quality is int
                if (!is_int($quality)) {
                    $this->addError("FSBM: Podana jakość nie jest liczbą!");
                    return false;
                }

                // check file is image
                if (!$this->isExtension($file, "image/*", true)) {
                    $this->addError("FSBM: Podany plik nie jest obrazem!");
                    return null;
                }

                $mimeExplode = explode("/", mime_content_type($file));
                $mime = $mimeExplode[1];

                if ($mime == "gif"){
                    $image = imagecreatefromgif($file);
                }
                if ($mime == "png"){
                    $image = imagecreatefrompng($file);
                }
                if ($mime == "bmp"or $mime == "x-ms-bmp"){
                    $image = imagecreatefrombmp($file);
                }
                if ($mime == "jpg" or $mime == "jpeg" or $mime == "jpe"){
                    $image = imagecreatefromjpeg($file);
                }
                if(function_exists('imagecreatefromavif')) {
                    if ($mime == "avif") {
                        $image = \imagecreatefromavif($file);
                    }
                }
                if(function_exists('imagecreatefromgd2')) {
                    if ($mime == "gd2") {
                        $image = \imagecreatefromgd2($file);
                    }
                }
                if(function_exists('imagecreatefromgd')) {
                    if ($mime == "gd") {
                        $image = \imagecreatefromgd($file);
                    }
                }
                if(function_exists('imagecreatefromstring')) {
                    if ($mime == "string") {
                        $image = \imagecreatefromstring($file);
                    }
                }
                if(function_exists('imagecreatefromtga')) {
                    if ($mime == "tga") {
                        $image = \imagecreatefromtga($file);
                    }
                }
                if(function_exists('imagecreatefromwbmp')) {
                    if ($mime == "wbmp") {
                        $image = \imagecreatefromtga($file);
                    }
                }
                if(function_exists('imagecreatefromwebp')) {
                    if ($mime == "webp") {
                        $image = \imagecreatefromtga($file);
                    }
                }
                if(function_exists('imagecreatefromxbm')) {
                    if ($mime == "xbm") {
                        $image = \imagecreatefromtga($file);
                    }
                }
                if(function_exists('imagecreatefromxpm')) {
                    if ($mime == "xpm") {
                        $image = \imagecreatefromtga($file);
                    }
                }

                // check image is not null
                if (!isset($image)) {
                    $this->addError("FSBM: Podany plik nie jest obrazem!");
                    return false;
                }

                // get image imagesx
                if (!$imageWidth = imagesx($image)) {
                    // return error
                    $this->addError("FSBM: Wystąpił błąd podczas pobierania szerokości obrazu!");
                    return false;
                }
                // get image imagesy
                if (!$imageHeight = imagesy($image)) {
                    // return error
                    $this->addError("FSBM: Wystąpił błąd podczas pobierania wysokości obrazu!");
                    return false;
                }

                // create the destination/output image.
                if (!$imageNew = imagecreatetruecolor($width, $height)) {
                    // return error
                    $this->addError("FSBM: Wystąpił błąd podczas tworzenia tła obrazu!");
                    return false;
                }

                if (!$coloa = imagecolorallocate($imageNew, 0, 0, 0)) {
                    // return error
                    $this->addError("FSBM: Wystąpił błąd podczas tworzenia tła obrazu!");
                }

                    // make image transparent
                if (!imagecolortransparent($imageNew, $coloa)) {
                    // return error
                    $this->addError("FSBM: Wystąpił błąd podczas tworzenia tła obrazu!");
                }

                if (!imagealphablending($imageNew, false)) {
                    // return error
                    $this->addError("FSBM: Wystąpił błąd podczas tworzenia tła obrazu!");
                }

                // enable alpha blending on the destination image.
                if (!imagealphablending($imageNew, false)) {
                    // return error
                    $this->addError("FSBM: Wystąpił błąd podczas ustawiania trybu alfa!");
                    return false;
                }

                if (!imagesavealpha($imageNew, true)) {
                    // return error
                    $this->addError("FSBM: Wystąpił błąd podczas ustawiania trybu alfa!");
                }

                // Allocate a transparent color and fill the new image with it.
                // Without this the image will have a black background instead of being transparent.
                if (!$transparent = imagecolorallocatealpha($imageNew, 0, 0, 0, 127)) {
                    // return error
                    $this->addError("FSBM: Wystąpił błąd podczas ustawiania koloru tła!");
                    return false;
                }
                if (!imagefill( $imageNew, 0, 0, $transparent )) {
                    // return error
                    $this->addError("FSBM: Wystąpił błąd podczas wypełniania tła!");
                    return false;
                }

                // copy the source image onto the new image.
                if (!imagecopyresized($imageNew, $image, 0, 0, 0, 0, $width, $height, $imageWidth, $imageHeight)) {
                    // return error
                    $this->addError("FSBM: Wystąpił błąd podczas kopiowania obrazu!");
                    return false;
                }

                // set path to save image
                $path = $this->path . $path . $name;

                // save the image
                if ($mime == "gif"){
                    $saved = imagegif($imageNew, $path);
                }
                if ($mime == "png"){
                    $quality = substr($quality, 0, -1);
                    if ($quality < 0) {
                        $quality = 0;
                    }else if ($quality > 9) {
                        $quality = 9;
                    }
                    $saved = imagepng($imageNew, $path, (int)$quality);
                }
                if ($mime == "bmp"or $mime == "x-ms-bmp"){
                    $saved = imagewbmp($imageNew, $path);
                }
                if ($mime == "jpg" or $mime == "jpeg" or $mime == "jpe" or $mime == "xpm" or $mime == "tga" or $mime == "string"){
                    $saved = imagejpeg($imageNew, $path, $quality);
                }
                if(function_exists('imageavif')) {
                    if ($mime == "avif") {
                        $saved = \imageavif($imageNew, $file, $quality);
                    }
                }
                if(function_exists('imagegd2')) {
                    if ($mime == "gd2") {
                        $saved = imagegd2($imageNew, $path);
                    }
                }
                if(function_exists('imagegd')) {
                    if ($mime == "gd") {
                        $saved = imagegd($imageNew, $path);
                    }
                }
                if(function_exists('imagewbmp')) {
                    if ($mime == "wbmp") {
                        $saved = imagewbmp($imageNew, $file);
                    }
                }
                if(function_exists('imagewebp')) {
                    if ($mime == "webp") {
                        $saved = imagewebp($imageNew, $file, $quality);
                    }
                }
                if(function_exists('imagexbm')) {
                    if ($mime == "xbm") {
                        $saved = imagexbm($imageNew, $file);
                    }
                }

                // check if image was saved
                if (!$saved) {
                    // return error
                    $this->addError("FSBM: Wystąpił błąd podczas zapisywania miniatury obrazu!");
                    return false;
                }

                // destroy the source image.
                imagedestroy($image);
                imagedestroy($imageNew);

                return true;
            } catch (\Throwable $th) {
                throw $this->addError($th);
                return false;
            }
        }

        // this function save uploaded image to the server
        public function saveUploadFile (string $path, string $file, string $name):bool {
            try {
                // check path is a dir
                if (!$this->isDir($path)) {
                    // return error
                    $this->addError("FSBM: Podany folder nie istnieje!");
                    return false;
                }
                // check file is a file
                if (!$this->isFile($file, true)) {
                    // return error
                    $this->addError("FSBM: Podany plik nie istnieje!");
                    return false;
                }

                // check file upload is a file
                if ($this->isFile($path . $name)) {
                    // return true
                    return true;
                }

                // save the file
                if (!move_uploaded_file($file, $this->path . $path . $name)) {
                    // return error
                    $this->addError("FSBM: Wystąpił błąd podczas zapisywania pliku!");
                    return false;
                }

                return true;
            } catch (\Throwable $th) {
                throw $this->addError($th);
                return false;
            }
        } 

        // this function check directory is empty
        public function isEmpty(string $path, bool $exp = false): bool {
            // check try error
            try {
                // check is a dir
                if (!is_dir((!$exp ? $this->path : '') . $path)) {
                    $this->addError("FSBM: Podana śćieżka nie jest folderem!");
                    return false;
                }
                // check is empty
                if (count(scandir((!$exp ? $this->path : '') . $path)) === 2) {
                    return true;
                }
                return false;
            } catch (\Throwable $th) {
                throw $this->addError($th);
                return false;
            }
        }

        // this function check is directory
        public function isDir(string $path, bool $exp = false): bool {
            // check try error
            try {
                // check is a dir
                if (is_dir((!$exp ? $this->path : '') . $path)) {
                    return true;
                }
                return false;
            } catch (\Throwable $th) {
                throw $this->addError($th);
                return false;
            }
        }
        
        // this function check directory exist
        public function isExistDir(string $path, bool $exp = false): bool {
            // check try error
            try {
                // check is file exists
                if (file_exists((!$exp ? $this->path : '') . $path)) {
                    return true;
                }
                return false;
            } catch (\Throwable $th) {
                throw $this->addError($th);
                return false;
            }
        }

        // this function check directory is file
        public function isFile(string $path, bool $exp = false): bool {
            // check try error
            try {
                // check is file
                if (is_file((!$exp ? $this->path : '') . $path)) {
                    return true;
                }
                return false;
            } catch (\Throwable $th) {
                throw $this->addError($th);
                return false;
            }
        }

        // this function check file is exist
        public function isExistFile(string $path, bool $exp = false): bool {
            // check try error
            try {
                // check is file
                if (file_exists((!$exp ? $this->path : '') . $path)) {
                    return true;
                }
                return false;
            } catch (\Throwable $th) {
                throw $this->addError($th);
                return false;
            }
        }

        // this function check file extension
        public function isExtension(string $path, string $extension, bool $exp = false): bool {
            // check try error
            try {
                // check is file
                if (is_file((!$exp ? $this->path : '') . $path)) {
                    // set mime type
                    $mime = mime_content_type((!$exp ? $this->path : '') . $path);
                    $mimes = explode("/", $mime);
                    $mimeMime = trim($mimes[0]);
                    $mimeExt = trim($mimes[1]);
                    // get multiply extension
                    $extensionMulttiply = explode(",", $extension);
                    // check extension
                    foreach ($extensionMulttiply as $key => $value) {
                        $value_mime = explode("/", $value);
                        $value_mime_mime = trim($value_mime[0]);
                        $value_mime_ext = trim($value_mime[1]);

                        if (($value_mime_mime === "*") || (($mimeMime === $value_mime_mime) && ($mimeExt === $value_mime_ext))) {
                            return true;
                            break;
                        } else if ($mimeMime === $value_mime_mime) {
                            return true;
                            break;
                        }  else if ($mimeExt === $value_mime_ext) {
                            return true;
                            break;
                        } 
                    }
                    
                }
                return false;
            } catch (\Throwable $th) {
                throw $this->addError($th);
                return false;
            }
        }

        // this function check file size
        public function isSize(string $path, int $size, bool $exp = false): bool {
            // check try error
            try {
                // check is file
                if (is_file((!$exp ? $this->path : '') . $path)) {
                    // check size
                    if (filesize((!$exp ? $this->path : '') . $path) <= $size) {
                        return true;
                    }
                    return false;
                }
                return false;
            } catch (\Throwable $th) {
                throw $this->addError($th);
                return false;
            }
        }

        // function return all error
        public function allError():array {
            return (array) $this->error;
        }

        //  function return first error
        public function firstError():string {
            return (string) $this->error[0];
        }
        
        //  function return last error
        public function lastError():string {
            return (string) $this->error[count($this->error)-1];
        }

        // function return a int error
        public function intErrorCode():int {
            return (int) count($this->error);
        }

        // function add error message
        public function addError(string $message) {
            array_push($this->error, $message);
        }
 
        function getRelativePath($basePath, $targetPath)
        {
            if ($basePath === $targetPath) {
                return '';
            }
    
            $sourceDirs = explode('/', isset($basePath[0]) && '/' === $basePath[0] ? substr($basePath, 1) : $basePath);
            $targetDirs = explode('/', isset($targetPath[0]) && '/' === $targetPath[0] ? substr($targetPath, 1) : $targetPath);
            array_pop($sourceDirs);
            $targetFile = array_pop($targetDirs);
    
            foreach ($sourceDirs as $i => $dir) {
                if (isset($targetDirs[$i]) && $dir === $targetDirs[$i]) {
                    unset($sourceDirs[$i], $targetDirs[$i]);
                } else {
                    break;
                }
            }
    
            $targetDirs[] = $targetFile;
            $path = str_repeat('../', count($sourceDirs)).implode('/', $targetDirs);
    
            return '' === $path || '/' === $path[0]
                || false !== ($colonPos = strpos($path, ':')) && ($colonPos < ($slashPos = strpos($path, '/')) || false === $slashPos)
                ? "./$path" : $path;
        }

        function getRelativePathAll($from, $to) {
            // some compatibility fixes for Windows paths
            $from = is_dir($from) ? rtrim($from, '\/') . '/' : $from;
            $to   = is_dir($to)   ? rtrim($to, '\/') . '/'   : $to;
            $from = str_replace('\\', '/', $from);
            $to   = str_replace('\\', '/', $to);

            $from     = explode('/', $from);
            $to       = explode('/', $to);
            $relPath  = $to;

            foreach($from as $depth => $dir) {
                // find first non-matching dir
                if($dir === $to[$depth]) {
                    // ignore this directory
                    array_shift($relPath);
                } else {
                    // get number of remaining dirs to $from
                    $remaining = count($from) - $depth;
                    if($remaining > 1) {
                        // add traversals up to first matching dir
                        $padLength = (count($relPath) + $remaining - 1) * -1;
                        $relPath = array_pad($relPath, $padLength, '..');
                        break;
                    } else {
                        $relPath[0] = './' . $relPath[0];
                    }
                }
            }
            return implode('/', $relPath);
        }

        // Author function (helloholahi)
        public function translate($path) {
            $dossier = $path; // folder to scan
            $array_exclude = array('.', '..', '.DS_Store'); // system files to exclude
            $array_sentences_list = array();

            if(is_dir($dossier)) // verify if is a folder
            {
                if($dh = opendir($dossier)) // open folder
                {
                    while(($file = readdir($dh)) !== false) // scan all files in the folder
                    {
                        if(!in_array($file, $array_exclude)) // exclude system files previously listed in array
                        {
                            echo "\n".'######## ' . strtoupper($file) . ' ##########'."\n";
                            $file1 = file('pages/'.$file); // path to the current file
                            foreach($file1 AS $fileline)
                            {
                                // regex : not start with a to z characters or a (
                                // then catch sentences into l(' and ')
                                // and put results in a $matchs array
                                preg_match_all("#[^a-z\(]l\('(.+)'\)#U", $fileline, $matchs);

                                // fetch the associative array
                                foreach($matchs AS $match_this)
                                {
                                    foreach($match_this AS $line)
                                    {
                                        // technique of "I do not want to break my head"
                                        if(substr($line, 0, 3) != "l('" AND substr($line, 0, 4) != " l('" AND substr($line, 0, 4) != ".l('")
                                        {
                                            // check if the sentence is not already listed
                                            if(!in_array($line, $array_sentences_list))
                                            {
                                                // if not, add it to the sentences list array and write it for fun !
                                                $array_sentences_list[] = $line;
                                                echo $line . "\n";
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                    closedir($dh);
                }
            }
        }

    }