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
*	This file is rendering plugin(widget)
*/

    namespace BlackMin\Plugin;

    use BlackMin\Plugin\bmWidgetContent;
    use BlackMin\View\View;

    final class PluginGenerate extends bmWidgetContent {

        /**
         * @var string
        */
        protected string $Path = BM_SETTINGS["url_server"] . "bm-content/plugins/";
        /**
         * @var string
        */
        protected string $Cache = "";
        /**
         * @var View
        */
        protected View $View;
        /**
         * @var string
        */
        protected string $Container = '<div class="bm-plugins-container bm-widget-container">';
        /**
         * @var string
        */
        protected string $ContainerEnd = "</div>";
        /**
         * @var string
        */
        protected string $WidgetSection = '<div class="bm-widget-section" bm-widget-parnet="%s" bm-widget-name="%s">';
        /**
         * @var string
        */
        protected string $WidgetSectionEnd = "</div>";

        public function __construct() {
            // view class set
            $this->View = new View();
        }

        private  function pluginSort($data) {
            $data = unserialize($data);

            // check data is empty
            if (count($data) === 0) {
                return true;
            }

            // check data is array
            if (!is_array($data)) {
                throw "BM: Widget structur is not array.";
            }

            parent::__construct();

            // clear Cache
            $this->Cache = "";

            foreach ($data as $key => $value) {
                // check if $value isset name_full and name
                if (!array_key_exists("name", $value) || !array_key_exists("name_full", $value)) {
                    throw "BM: Widget structur is destroyed.";
                    break;
                }

                if ($value["name"] === "blackmin") {
                    $this->Cache .= sprintf($this->WidgetSection, $value["name"], $value["name_full"]);
                    $this->Cache .= self::$widgetContent[$value["name_full"]];
                    $this->Cache .= $this->WidgetSectionEnd;
                    continue;
                }

                $this->View->set($this->Path . $value["name"] . "/" . $value["name_full"] . ".php");
                $render = $this->View->render(true);
                if ($render !== false) {
                    $this->Cache .= sprintf($this->WidgetSection, $value["name"], $value["name_full"]);
                    $this->Cache .= $render;
                    $this->Cache .= $this->WidgetSectionEnd;
                    continue;
                }

                throw "BM: Widget error render.";
                break;
            }

            if ($this->Cache === "") {
                return true;
            }

            return $this->Container . $this->Cache . $this->ContainerEnd;
        }

        final public function pluginLoad (string $nameWidget) {
            
            if ($nameWidget === "bm_widget_top") {
                return $this->pluginSort(BM_SETTINGS["bm_top_widget"]);
            }
            if ($nameWidget === "bm_widget_left") {
                return $this->pluginSort(BM_SETTINGS["bm_left_widget"]);
            }
            if ($nameWidget === "bm_widget_right") {
                return $this->pluginSort(BM_SETTINGS["bm_right_widget"]);
            }
            if ($nameWidget === "bm_widget_bottom") {
                return $this->pluginSort(BM_SETTINGS["bm_bottom_widget"]);
            }
            if ($nameWidget === "bm_widget_footer") {
                return $this->pluginSort(BM_SETTINGS["bm_footer_widget"]);
            }

            return false;

        }
    }
    