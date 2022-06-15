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
                $glob = glob(($path === '' ? $this->path : $path) . $pattern, $flags | GLOB_MARK);

                if (!$glob) {
                    $this->addError("FSBM: Wystąpił bład pod czas pobierania wgranych plików!");
                }
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

                        if (!$dir) {
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

        // function remove file in directory
        public function remove() {
            # code...
        }

        // function remove directory
        public function removeDirectory() {
            # code...
        }

        // function remove file
        public function removeFile(){
            # code...
        }

        // this function change hmod in directory (only)
        public function hmod() {
            # code...
        }

        // this function is coppy all 
        public function copy() {
            # code...
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