<?php
/**
 * This file is part of the blackmin package.
 *
 * (c) BlackMin
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace BlackMin;

class Settings
{
    private $database;

    protected $save = null;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function count() {
        return $this->save;
    }
    public function loadSettings()
    {
        $t = $this->database->query("SELECT * FROM `bm_ustawienia_bm`", false);

        $this->save = $t["num_rows"];

        // buffor
        $c = [];

        for ($i=0; $i < $t["num_rows"]; $i++) {
            $c[$t[$i]["bm_nazwa"]] = $t[$i]["bm_wartosc"];
        }

        return $c;
    }
}
