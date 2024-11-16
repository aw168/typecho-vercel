<?php  
if (!defined('__TYPECHO_ROOT_DIR__')) exit;  
  
/**  
 * Typecho 采集插件  
 *  
 * @package Piano_gather  
 * @version 1.0  
 * @author 02  
 * @link https://www.aiu6.cn
 */  
class Piano_gather_Plugin implements Typecho_Plugin_Interface  
{  
    /**  
     * 激活插件方法  
     *  
     * @access public  
     * @return void  
     */  
    public static function activate()  
    {  
        Typecho_Plugin::factory('Widget_Archive')->footer = array('Piano_gather_Plugin', 'footerScript');  
        // 可以在这里添加激活时的其他操作  
    }  
  
    /**  
     * 禁用插件方法  
     *  
     * @access public  
     * @return void  
     */  
    public static function deactivate()  
    {  
        // 可以在这里添加禁用时的操作，如清理设置等  
    }  
  
    /**  
     * 配置插件方法  
     *  
     * @access public  
     * @param Typecho_Widget_Helper_Form $form 插件配置表单  
     * @return void  
     */  
    public static function config(Typecho_Widget_Helper_Form $form)  
    {  
        $apiKey = new Typecho_Widget_Helper_Form_Element_Text(  
            'apiKey', NULL, NULL,  
            _t('API Key'),  
            _t('请输入你的API Key。')  
        );  
        $form->addInput($apiKey); 
        require("mayiu.php");
    }  
  
    /**  
     * 个人用户的配置面板  
     *  
     * @access public  
     * @param Typecho_Widget_Helper_Form $form 插件配置表单  
     * @return void  
     */  
    public static function personalConfig(Typecho_Widget_Helper_Form $form)  
    {  
        // 如果需要针对个人用户的配置，可以在这里添加  
    }  
  
    /**  
     * 获取插件配置  
     *  
     * @access public  
     * @return array  
     */  
    public static function getOptions()  
    {  
        return Typecho_Widget::widget('Widget_Options')->plugin('Piano_gather');  
    }  
  
    /**  
     * 插件的其它方法  
     */  
    public static function footerScript()  
    {  
        $options = self::getOptions();  
        $apiKey = $options->apiKey;  
  
        // 使用配置的API Key做某些操作，例如发起API请求  
        // 这里仅作为示例，输出API Key到控制台  
        echo '<script type="text/javascript">console.log("Piano_gather 插件已加载，API Key: ' . htmlspecialchars($apiKey) . '");</script>';  
    }  
}