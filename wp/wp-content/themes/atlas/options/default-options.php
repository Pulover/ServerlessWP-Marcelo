<?php
/**
 * Defined default options
 *
 * @package Atlas
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly;
}

/*
 -------------------------------------------------------------------------------
 * Default Redux JSON
 * -----------------------------------------------------------------------------
 */
if ( ! function_exists( 'th90_default_redux' ) ) {
    function th90_default_redux() {
        $arr_json = '{"last_tab":"","site_width":"1070","content_width":"69","sidebar_sticky":"1","box_active":"1","box_style":"solid","box_radius":"10","button_radius":"10","image_radius":"10","wheading_style":"simple","wheading_center":"0","wheading_bg":"","wheading_color":"","scroll_top":"1","cat_colors":"1","site_skin":"light","skin_switcher":"1","light-bg-color":"#f7f9f8","light-sec-bg-color":"#ffffff","light-text-color":{"color":"#202124","alpha":"1","rgba":"rgba(32,33,36,1)"},"light-text-color-heavier":{"color":"#000000","alpha":"1","rgba":"rgba(0,0,0,1)"},"light-text-color-lighter":{"color":"#999999","alpha":"1","rgba":"rgba(153,153,153,1)"},"light-line-color":{"color":"#efefef","alpha":"1","rgba":"rgba(239,239,239,1)"},"light-submenu-bg":{"color":"#f5f5f5","alpha":"1","rgba":"rgba(245,245,245,1)"},"dark-bg-color":"#1c1c1c","dark-sec-bg-color":"#161617","dark-text-color":{"color":"#ffffff","alpha":"0.8","rgba":"rgba(255,255,255,0.8)"},"dark-text-color-heavier":{"color":"#ffffff","alpha":"1","rgba":"rgba(255,255,255,1)"},"dark-text-color-lighter":{"color":"#ffffff","alpha":"0.6","rgba":"rgba(255,255,255,0.6)"},"dark-line-color":{"color":"#ffffff","alpha":"0.1","rgba":"rgba(255,255,255,0.1)"},"dark-submenu-bg":{"color":"#000000","alpha":"1","rgba":"rgba(0,0,0,1)"},"color-accent":"#3d55ef","color-accent-text":"#ffffff","primary_text":{"font-family":"Poppins","font-options":"","google":"1","font-weight":"400","font-style":"","font-size":"14px","line-height":"1.7","letter-spacing":"0em"},"second_text":{"font-family":"Poppins","font-options":"","google":"1","font-weight":"400","font-style":"","text-transform":"","font-size":"12px","line-height":"1.5","letter-spacing":"0em"},"font_heading":{"font-family":"Poppins","font-options":"","google":"1","font-weight":"700","font-style":"","text-transform":"","line-height":"","letter-spacing":""},"widget_head_typo":{"font-family":"","font-options":"","google":"1","font-weight":"","font-style":"","text-transform":"","font-size":"","letter-spacing":""},"h1_desktop":{"font-size":"28px"},"h2_desktop":{"font-size":"24px"},"h3_desktop":{"font-size":"21px"},"h4_desktop":{"font-size":"18px"},"h5_desktop":{"font-size":"16px"},"h6_desktop":{"font-size":"14px"},"h1_tablet":{"font-size":"28px"},"h2_tablet":{"font-size":"24px"},"h3_tablet":{"font-size":"21px"},"h4_tablet":{"font-size":"18px"},"h5_tablet":{"font-size":"16px"},"h6_tablet":{"font-size":"14px"},"h1_mobile":{"font-size":"28px"},"h2_mobile":{"font-size":"24px"},"h3_mobile":{"font-size":"21px"},"h4_mobile":{"font-size":"18px"},"h5_mobile":{"font-size":"18px"},"h6_mobile":{"font-size":"14px"},"logo_type":"svg","logo":{"url":"","id":"","height":"","width":"","thumbnail":""},"logo_retina":{"url":"","id":"","height":"","width":"","thumbnail":""},"logo_dark":{"url":"","id":"","height":"","width":"","thumbnail":""},"logo_dark_retina":{"url":"","id":"","height":"","width":"","thumbnail":""},"logo_width":{"width":"","units":"px"},"logo_svg":"<svg xmlns=\"http:\/\/www.w3.org\/2000\/svg\" viewBox=\"0 0 127 37\"><path d=\"m9.36 36 2.016-5.952h12.576L25.968 36h8.688L22.464 2.304H12.96L.768 36H9.36Zm12.48-12.288h-8.304l4.128-12.336 4.176 12.336ZM53.28 36v-6.96h-2.928c-.896 0-1.536-.176-1.92-.528-.384-.352-.576-.928-.576-1.728V16.032h5.376V9.216h-5.376V2.688h-8.208v6.528h-3.264v6.816h3.264v10.656c0 3.296.832 5.672 2.496 7.128C43.808 35.272 46.128 36 49.104 36h4.176Zm12.768 0V.48H57.84V36h8.208Zm16.08.384c1.888 0 3.544-.384 4.968-1.152 1.424-.768 2.536-1.776 3.336-3.024V36h8.208V9.216h-8.208v3.792c-.768-1.248-1.864-2.256-3.288-3.024-1.424-.768-3.08-1.152-4.968-1.152-2.208 0-4.208.56-6 1.68-1.792 1.12-3.208 2.72-4.248 4.8-1.04 2.08-1.56 4.496-1.56 7.248s.52 5.176 1.56 7.272 2.456 3.712 4.248 4.848c1.792 1.136 3.776 1.704 5.952 1.704Zm2.448-7.152c-1.632 0-3.016-.6-4.152-1.8-1.136-1.2-1.704-2.824-1.704-4.872s.568-3.656 1.704-4.824c1.136-1.168 2.52-1.752 4.152-1.752 1.632 0 3.016.592 4.152 1.776 1.136 1.184 1.704 2.8 1.704 4.848s-.568 3.664-1.704 4.848c-1.136 1.184-2.52 1.776-4.152 1.776Zm30.912 7.152c2.176 0 4.088-.352 5.736-1.056 1.648-.704 2.912-1.672 3.792-2.904.88-1.232 1.32-2.632 1.32-4.2-.032-1.856-.52-3.336-1.464-4.44-.944-1.104-2.04-1.904-3.288-2.4-1.248-.496-2.864-1-4.848-1.512-1.728-.384-3-.768-3.816-1.152-.816-.384-1.224-.96-1.224-1.728 0-.64.256-1.144.768-1.512.512-.368 1.248-.552 2.208-.552 1.12 0 2.024.272 2.712.816.688.544 1.096 1.28 1.224 2.208h7.584c-.288-2.752-1.4-4.96-3.336-6.624-1.936-1.664-4.584-2.496-7.944-2.496-2.272 0-4.232.368-5.88 1.104-1.648.736-2.896 1.736-3.744 3a7.376 7.376 0 0 0-1.272 4.2c0 1.824.464 3.272 1.392 4.344a8.293 8.293 0 0 0 3.312 2.352c1.28.496 2.88.968 4.8 1.416 1.792.448 3.088.856 3.888 1.224.8.368 1.2.936 1.2 1.704 0 .64-.28 1.16-.84 1.56-.56.4-1.352.6-2.376.6-1.12 0-2.064-.288-2.832-.864-.768-.576-1.2-1.328-1.296-2.256h-8.112a8.649 8.649 0 0 0 1.776 4.68c1.056 1.392 2.496 2.488 4.32 3.288 1.824.8 3.904 1.2 6.24 1.2Z\"\/><\/svg>\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t","logo_dark_svg":"<svg xmlns=\"http:\/\/www.w3.org\/2000\/svg\" viewBox=\"0 0 127 37\"><path fill=\"#FFF\" d=\"m9.36 36 2.016-5.952h12.576L25.968 36h8.688L22.464 2.304H12.96L.768 36H9.36Zm12.48-12.288h-8.304l4.128-12.336 4.176 12.336ZM53.28 36v-6.96h-2.928c-.896 0-1.536-.176-1.92-.528-.384-.352-.576-.928-.576-1.728V16.032h5.376V9.216h-5.376V2.688h-8.208v6.528h-3.264v6.816h3.264v10.656c0 3.296.832 5.672 2.496 7.128C43.808 35.272 46.128 36 49.104 36h4.176Zm12.768 0V.48H57.84V36h8.208Zm16.08.384c1.888 0 3.544-.384 4.968-1.152 1.424-.768 2.536-1.776 3.336-3.024V36h8.208V9.216h-8.208v3.792c-.768-1.248-1.864-2.256-3.288-3.024-1.424-.768-3.08-1.152-4.968-1.152-2.208 0-4.208.56-6 1.68-1.792 1.12-3.208 2.72-4.248 4.8-1.04 2.08-1.56 4.496-1.56 7.248s.52 5.176 1.56 7.272 2.456 3.712 4.248 4.848c1.792 1.136 3.776 1.704 5.952 1.704Zm2.448-7.152c-1.632 0-3.016-.6-4.152-1.8-1.136-1.2-1.704-2.824-1.704-4.872s.568-3.656 1.704-4.824c1.136-1.168 2.52-1.752 4.152-1.752 1.632 0 3.016.592 4.152 1.776 1.136 1.184 1.704 2.8 1.704 4.848s-.568 3.664-1.704 4.848c-1.136 1.184-2.52 1.776-4.152 1.776Zm30.912 7.152c2.176 0 4.088-.352 5.736-1.056 1.648-.704 2.912-1.672 3.792-2.904.88-1.232 1.32-2.632 1.32-4.2-.032-1.856-.52-3.336-1.464-4.44-.944-1.104-2.04-1.904-3.288-2.4-1.248-.496-2.864-1-4.848-1.512-1.728-.384-3-.768-3.816-1.152-.816-.384-1.224-.96-1.224-1.728 0-.64.256-1.144.768-1.512.512-.368 1.248-.552 2.208-.552 1.12 0 2.024.272 2.712.816.688.544 1.096 1.28 1.224 2.208h7.584c-.288-2.752-1.4-4.96-3.336-6.624-1.936-1.664-4.584-2.496-7.944-2.496-2.272 0-4.232.368-5.88 1.104-1.648.736-2.896 1.736-3.744 3a7.376 7.376 0 0 0-1.272 4.2c0 1.824.464 3.272 1.392 4.344a8.293 8.293 0 0 0 3.312 2.352c1.28.496 2.88.968 4.8 1.416 1.792.448 3.088.856 3.888 1.224.8.368 1.2.936 1.2 1.704 0 .64-.28 1.16-.84 1.56-.56.4-1.352.6-2.376.6-1.12 0-2.064-.288-2.832-.864-.768-.576-1.2-1.328-1.296-2.256h-8.112a8.649 8.649 0 0 0 1.776 4.68c1.056 1.392 2.496 2.488 4.32 3.288 1.824.8 3.904 1.2 6.24 1.2Z\"\/><\/svg>\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t","logo_svg_width":{"width":"74px","units":"px"},"logo_mobile_type":"svg","logo_mobile":{"url":"","id":"","height":"","width":"","thumbnail":""},"logo_mobile_retina":{"url":"","id":"","height":"","width":"","thumbnail":""},"logo_dark_mobile":{"url":"","id":"","height":"","width":"","thumbnail":""},"logo_dark_mobile_retina":{"url":"","id":"","height":"","width":"","thumbnail":""},"logo_mobile_width":{"width":"","units":"px"},"logo_mobile_svg":"<svg xmlns=\"http:\/\/www.w3.org\/2000\/svg\" viewBox=\"0 0 127 37\"><path d=\"m9.36 36 2.016-5.952h12.576L25.968 36h8.688L22.464 2.304H12.96L.768 36H9.36Zm12.48-12.288h-8.304l4.128-12.336 4.176 12.336ZM53.28 36v-6.96h-2.928c-.896 0-1.536-.176-1.92-.528-.384-.352-.576-.928-.576-1.728V16.032h5.376V9.216h-5.376V2.688h-8.208v6.528h-3.264v6.816h3.264v10.656c0 3.296.832 5.672 2.496 7.128C43.808 35.272 46.128 36 49.104 36h4.176Zm12.768 0V.48H57.84V36h8.208Zm16.08.384c1.888 0 3.544-.384 4.968-1.152 1.424-.768 2.536-1.776 3.336-3.024V36h8.208V9.216h-8.208v3.792c-.768-1.248-1.864-2.256-3.288-3.024-1.424-.768-3.08-1.152-4.968-1.152-2.208 0-4.208.56-6 1.68-1.792 1.12-3.208 2.72-4.248 4.8-1.04 2.08-1.56 4.496-1.56 7.248s.52 5.176 1.56 7.272 2.456 3.712 4.248 4.848c1.792 1.136 3.776 1.704 5.952 1.704Zm2.448-7.152c-1.632 0-3.016-.6-4.152-1.8-1.136-1.2-1.704-2.824-1.704-4.872s.568-3.656 1.704-4.824c1.136-1.168 2.52-1.752 4.152-1.752 1.632 0 3.016.592 4.152 1.776 1.136 1.184 1.704 2.8 1.704 4.848s-.568 3.664-1.704 4.848c-1.136 1.184-2.52 1.776-4.152 1.776Zm30.912 7.152c2.176 0 4.088-.352 5.736-1.056 1.648-.704 2.912-1.672 3.792-2.904.88-1.232 1.32-2.632 1.32-4.2-.032-1.856-.52-3.336-1.464-4.44-.944-1.104-2.04-1.904-3.288-2.4-1.248-.496-2.864-1-4.848-1.512-1.728-.384-3-.768-3.816-1.152-.816-.384-1.224-.96-1.224-1.728 0-.64.256-1.144.768-1.512.512-.368 1.248-.552 2.208-.552 1.12 0 2.024.272 2.712.816.688.544 1.096 1.28 1.224 2.208h7.584c-.288-2.752-1.4-4.96-3.336-6.624-1.936-1.664-4.584-2.496-7.944-2.496-2.272 0-4.232.368-5.88 1.104-1.648.736-2.896 1.736-3.744 3a7.376 7.376 0 0 0-1.272 4.2c0 1.824.464 3.272 1.392 4.344a8.293 8.293 0 0 0 3.312 2.352c1.28.496 2.88.968 4.8 1.416 1.792.448 3.088.856 3.888 1.224.8.368 1.2.936 1.2 1.704 0 .64-.28 1.16-.84 1.56-.56.4-1.352.6-2.376.6-1.12 0-2.064-.288-2.832-.864-.768-.576-1.2-1.328-1.296-2.256h-8.112a8.649 8.649 0 0 0 1.776 4.68c1.056 1.392 2.496 2.488 4.32 3.288 1.824.8 3.904 1.2 6.24 1.2Z\"\/><\/svg>\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t","logo_dark_mobile_svg":"<svg xmlns=\"http:\/\/www.w3.org\/2000\/svg\" viewBox=\"0 0 127 37\"><path fill=\"#FFF\" d=\"m9.36 36 2.016-5.952h12.576L25.968 36h8.688L22.464 2.304H12.96L.768 36H9.36Zm12.48-12.288h-8.304l4.128-12.336 4.176 12.336ZM53.28 36v-6.96h-2.928c-.896 0-1.536-.176-1.92-.528-.384-.352-.576-.928-.576-1.728V16.032h5.376V9.216h-5.376V2.688h-8.208v6.528h-3.264v6.816h3.264v10.656c0 3.296.832 5.672 2.496 7.128C43.808 35.272 46.128 36 49.104 36h4.176Zm12.768 0V.48H57.84V36h8.208Zm16.08.384c1.888 0 3.544-.384 4.968-1.152 1.424-.768 2.536-1.776 3.336-3.024V36h8.208V9.216h-8.208v3.792c-.768-1.248-1.864-2.256-3.288-3.024-1.424-.768-3.08-1.152-4.968-1.152-2.208 0-4.208.56-6 1.68-1.792 1.12-3.208 2.72-4.248 4.8-1.04 2.08-1.56 4.496-1.56 7.248s.52 5.176 1.56 7.272 2.456 3.712 4.248 4.848c1.792 1.136 3.776 1.704 5.952 1.704Zm2.448-7.152c-1.632 0-3.016-.6-4.152-1.8-1.136-1.2-1.704-2.824-1.704-4.872s.568-3.656 1.704-4.824c1.136-1.168 2.52-1.752 4.152-1.752 1.632 0 3.016.592 4.152 1.776 1.136 1.184 1.704 2.8 1.704 4.848s-.568 3.664-1.704 4.848c-1.136 1.184-2.52 1.776-4.152 1.776Zm30.912 7.152c2.176 0 4.088-.352 5.736-1.056 1.648-.704 2.912-1.672 3.792-2.904.88-1.232 1.32-2.632 1.32-4.2-.032-1.856-.52-3.336-1.464-4.44-.944-1.104-2.04-1.904-3.288-2.4-1.248-.496-2.864-1-4.848-1.512-1.728-.384-3-.768-3.816-1.152-.816-.384-1.224-.96-1.224-1.728 0-.64.256-1.144.768-1.512.512-.368 1.248-.552 2.208-.552 1.12 0 2.024.272 2.712.816.688.544 1.096 1.28 1.224 2.208h7.584c-.288-2.752-1.4-4.96-3.336-6.624-1.936-1.664-4.584-2.496-7.944-2.496-2.272 0-4.232.368-5.88 1.104-1.648.736-2.896 1.736-3.744 3a7.376 7.376 0 0 0-1.272 4.2c0 1.824.464 3.272 1.392 4.344a8.293 8.293 0 0 0 3.312 2.352c1.28.496 2.88.968 4.8 1.416 1.792.448 3.088.856 3.888 1.224.8.368 1.2.936 1.2 1.704 0 .64-.28 1.16-.84 1.56-.56.4-1.352.6-2.376.6-1.12 0-2.064-.288-2.832-.864-.768-.576-1.2-1.328-1.296-2.256h-8.112a8.649 8.649 0 0 0 1.776 4.68c1.056 1.392 2.496 2.488 4.32 3.288 1.824.8 3.904 1.2 6.24 1.2Z\"\/><\/svg>\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t","logo_mobile_svg_width":{"width":"74px","units":"px"},"logo_offcanvas_type":"svg","logo_offcanvas":{"url":"","id":"","height":"","width":"","thumbnail":""},"logo_offcanvas_retina":{"url":"","id":"","height":"","width":"","thumbnail":""},"logo_dark_offcanvas":{"url":"","id":"","height":"","width":"","thumbnail":""},"logo_dark_offcanvas_retina":{"url":"","id":"","height":"","width":"","thumbnail":""},"logo_offcanvas_width":{"width":"","units":"px"},"logo_offcanvas_svg":"<svg xmlns=\"http:\/\/www.w3.org\/2000\/svg\" viewBox=\"0 0 127 37\"><path d=\"m9.36 36 2.016-5.952h12.576L25.968 36h8.688L22.464 2.304H12.96L.768 36H9.36Zm12.48-12.288h-8.304l4.128-12.336 4.176 12.336ZM53.28 36v-6.96h-2.928c-.896 0-1.536-.176-1.92-.528-.384-.352-.576-.928-.576-1.728V16.032h5.376V9.216h-5.376V2.688h-8.208v6.528h-3.264v6.816h3.264v10.656c0 3.296.832 5.672 2.496 7.128C43.808 35.272 46.128 36 49.104 36h4.176Zm12.768 0V.48H57.84V36h8.208Zm16.08.384c1.888 0 3.544-.384 4.968-1.152 1.424-.768 2.536-1.776 3.336-3.024V36h8.208V9.216h-8.208v3.792c-.768-1.248-1.864-2.256-3.288-3.024-1.424-.768-3.08-1.152-4.968-1.152-2.208 0-4.208.56-6 1.68-1.792 1.12-3.208 2.72-4.248 4.8-1.04 2.08-1.56 4.496-1.56 7.248s.52 5.176 1.56 7.272 2.456 3.712 4.248 4.848c1.792 1.136 3.776 1.704 5.952 1.704Zm2.448-7.152c-1.632 0-3.016-.6-4.152-1.8-1.136-1.2-1.704-2.824-1.704-4.872s.568-3.656 1.704-4.824c1.136-1.168 2.52-1.752 4.152-1.752 1.632 0 3.016.592 4.152 1.776 1.136 1.184 1.704 2.8 1.704 4.848s-.568 3.664-1.704 4.848c-1.136 1.184-2.52 1.776-4.152 1.776Zm30.912 7.152c2.176 0 4.088-.352 5.736-1.056 1.648-.704 2.912-1.672 3.792-2.904.88-1.232 1.32-2.632 1.32-4.2-.032-1.856-.52-3.336-1.464-4.44-.944-1.104-2.04-1.904-3.288-2.4-1.248-.496-2.864-1-4.848-1.512-1.728-.384-3-.768-3.816-1.152-.816-.384-1.224-.96-1.224-1.728 0-.64.256-1.144.768-1.512.512-.368 1.248-.552 2.208-.552 1.12 0 2.024.272 2.712.816.688.544 1.096 1.28 1.224 2.208h7.584c-.288-2.752-1.4-4.96-3.336-6.624-1.936-1.664-4.584-2.496-7.944-2.496-2.272 0-4.232.368-5.88 1.104-1.648.736-2.896 1.736-3.744 3a7.376 7.376 0 0 0-1.272 4.2c0 1.824.464 3.272 1.392 4.344a8.293 8.293 0 0 0 3.312 2.352c1.28.496 2.88.968 4.8 1.416 1.792.448 3.088.856 3.888 1.224.8.368 1.2.936 1.2 1.704 0 .64-.28 1.16-.84 1.56-.56.4-1.352.6-2.376.6-1.12 0-2.064-.288-2.832-.864-.768-.576-1.2-1.328-1.296-2.256h-8.112a8.649 8.649 0 0 0 1.776 4.68c1.056 1.392 2.496 2.488 4.32 3.288 1.824.8 3.904 1.2 6.24 1.2Z\"\/><\/svg>\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t","logo_dark_offcanvas_svg":"<svg xmlns=\"http:\/\/www.w3.org\/2000\/svg\" viewBox=\"0 0 127 37\"><path fill=\"#FFF\" d=\"m9.36 36 2.016-5.952h12.576L25.968 36h8.688L22.464 2.304H12.96L.768 36H9.36Zm12.48-12.288h-8.304l4.128-12.336 4.176 12.336ZM53.28 36v-6.96h-2.928c-.896 0-1.536-.176-1.92-.528-.384-.352-.576-.928-.576-1.728V16.032h5.376V9.216h-5.376V2.688h-8.208v6.528h-3.264v6.816h3.264v10.656c0 3.296.832 5.672 2.496 7.128C43.808 35.272 46.128 36 49.104 36h4.176Zm12.768 0V.48H57.84V36h8.208Zm16.08.384c1.888 0 3.544-.384 4.968-1.152 1.424-.768 2.536-1.776 3.336-3.024V36h8.208V9.216h-8.208v3.792c-.768-1.248-1.864-2.256-3.288-3.024-1.424-.768-3.08-1.152-4.968-1.152-2.208 0-4.208.56-6 1.68-1.792 1.12-3.208 2.72-4.248 4.8-1.04 2.08-1.56 4.496-1.56 7.248s.52 5.176 1.56 7.272 2.456 3.712 4.248 4.848c1.792 1.136 3.776 1.704 5.952 1.704Zm2.448-7.152c-1.632 0-3.016-.6-4.152-1.8-1.136-1.2-1.704-2.824-1.704-4.872s.568-3.656 1.704-4.824c1.136-1.168 2.52-1.752 4.152-1.752 1.632 0 3.016.592 4.152 1.776 1.136 1.184 1.704 2.8 1.704 4.848s-.568 3.664-1.704 4.848c-1.136 1.184-2.52 1.776-4.152 1.776Zm30.912 7.152c2.176 0 4.088-.352 5.736-1.056 1.648-.704 2.912-1.672 3.792-2.904.88-1.232 1.32-2.632 1.32-4.2-.032-1.856-.52-3.336-1.464-4.44-.944-1.104-2.04-1.904-3.288-2.4-1.248-.496-2.864-1-4.848-1.512-1.728-.384-3-.768-3.816-1.152-.816-.384-1.224-.96-1.224-1.728 0-.64.256-1.144.768-1.512.512-.368 1.248-.552 2.208-.552 1.12 0 2.024.272 2.712.816.688.544 1.096 1.28 1.224 2.208h7.584c-.288-2.752-1.4-4.96-3.336-6.624-1.936-1.664-4.584-2.496-7.944-2.496-2.272 0-4.232.368-5.88 1.104-1.648.736-2.896 1.736-3.744 3a7.376 7.376 0 0 0-1.272 4.2c0 1.824.464 3.272 1.392 4.344a8.293 8.293 0 0 0 3.312 2.352c1.28.496 2.88.968 4.8 1.416 1.792.448 3.088.856 3.888 1.224.8.368 1.2.936 1.2 1.704 0 .64-.28 1.16-.84 1.56-.56.4-1.352.6-2.376.6-1.12 0-2.064-.288-2.832-.864-.768-.576-1.2-1.328-1.296-2.256h-8.112a8.649 8.649 0 0 0 1.776 4.68c1.056 1.392 2.496 2.488 4.32 3.288 1.824.8 3.904 1.2 6.24 1.2Z\"\/><\/svg>\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t","logo_offcanvas_svg_width":{"width":"74px","units":"px"},"header_space":"25","mheader_space":"25","sticky_behaviour":"both","footer_bg_custom":"","copyright_text":"Designed by tmrwstudio - Newspaper WordPress Theme\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t","post_layout":"1","featured_height":"400","post_sidebar_position":"right","box_post":"1","breadcrumbs":"1","post_featured_ratio":"16_9","post_title_center":"0","post_meta":{"author":"1","date":"1","comments":"1","last_update":"","reading_time":"","review":"","views":""},"post_meta_modern":"1","meta_time_format":"modern","post_cats":"1","post_cats_style":"btn","post_tags":"1","post_nav":"1","post_author":"1","post_comment":"1","post_comment_collapse":"","social_shares_post":{"facebook":"1","twitter":"1","pinterest":"1","telegram":"1","linkedin":"1","tumblr":"1","reddit":"1","vkontakte":"1","whatsapp":"","email":""},"social_shares_pos":"sticky","social_shares_style":"simple","single_ajax_post":"0","single_ajax_cat":"0","reading_indicator":"1","reading_indicator_height":"3","reading_indicator_pos":"bottom","post_content_typo":{"font-size":"","line-height":"","letter-spacing":""},"post_heading_typo":{"font-family":"","font-options":"","google":"1","font-weight":"","font-style":"","text-transform":"","font-size":"","letter-spacing":""},"post_excerpt_typo":{"font-family":"","font-options":"","google":"1","font-weight":"","font-style":"","text-transform":"","font-size":"","letter-spacing":""},"page_sidebar":"right","archive_sidebar":"right","search_sidebar":"right","offcanvas_width":{"width":"300px","units":"px"},"offcanvas_bg":"inherit","off_overlay_light":{"color":"#f5f8fa","alpha":"1","rgba":"rgba(245,248,250,1)"},"off_overlay_dark":{"color":"#161617","alpha":"1","rgba":"rgba(22,22,23,1)"},"show_offcanvas_logo":"1","mobile_menu_typo":{"font-family":"","font-options":"","google":"1","font-weight":"","font-style":"","text-transform":"","font-size":"","line-height":"","letter-spacing":""},"disable_lazyload_img_placeholder":"1","disable_elementor_jquery":"1","disable_elementor_swiper":"0","disable_elementor_google_font":"1","disable_emojis":"1","disable_woocommerce_assets_out_of_shop":"1","disable_woocommerce_block":"1","disable_gutenberg_assets":"1","contact7_page":"1","site_markup":"1","site_desc":"\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t","post_rich_snippet":"1","post_schema_type":"Article","post_og_cards":"1","facebook_app_id":"","facebook_default_img":{"url":"","id":"","height":"","width":"","thumbnail":""},"shop_sidebar":"full","shop_number":"12","product_title_tag":"h5","product_sidebar":"full","product_gallery_thumb":"4","social_shares_product":{"facebook":"1","twitter":"1","pinterest":"1","telegram":"","linkedin":"1","tumblr":"","reddit":"","vkontakte":"","whatsapp":"","email":""},"redux-backup":1}';
        return json_decode( $arr_json, true );
    }
}

/*
 -------------------------------------------------------------------------------
 * Save Default Options Array of Theme
 * -----------------------------------------------------------------------------
 */
if ( ! function_exists( 'th90_add_opt_arr_default' ) ) {
    function th90_add_opt_arr_default() {
        if ( ! get_option( 'th90-color-accent' ) ) {
            update_option( 'th90-color-accent', th90_default_redux()['color-accent'] );
        }
        if ( ! get_option( 'th90-dark-sec-bg-color' ) ) {
            update_option( 'th90-dark-sec-bg-color', th90_default_redux()['dark-sec-bg-color'] );
        }
        if ( ! get_option( 'th90-light-sec-bg-color' ) ) {
            update_option( 'th90-light-sec-bg-color', th90_default_redux()['light-sec-bg-color'] );
        }
    }
    add_action('after_switch_theme', 'th90_add_opt_arr_default');
}

/*
 -------------------------------------------------------------------------------
 * Save Default Colors for Gutenberg
 * -----------------------------------------------------------------------------
 */
if ( ! function_exists( 'th90_update_opt_colors' ) ) {
    function th90_update_opt_colors() {
        update_option( 'th90-color-accent', th90_opt( 'color-accent' ) );
        update_option( 'th90-dark-sec-bg-color', th90_opt( 'dark-sec-bg-color' ) );
        update_option( 'th90-light-sec-bg-color', th90_opt( 'light-sec-bg-color' ) );
    }
    add_action('redux/options/th90_options/saved', 'th90_update_opt_colors', 0);
}

/*
 -------------------------------------------------------------------------------
 * Default theme options value
 * -----------------------------------------------------------------------------
 */
if ( ! function_exists( 'th90_default_options' ) ) {
    function th90_default_options() {
		$admin_images =  get_parent_theme_file_uri(). '/images/admin/';

        $def = array();

        $def['sidebar_layouts'] = array(
			'right' => array( 'img' => $admin_images . 'sidebar/1.png' ),
			'left' => array( 'img' => $admin_images . 'sidebar/2.png' ),
			'one_column' => array( 'img' => $admin_images . 'sidebar/3.png' ),
			'full' => array( 'img' => $admin_images . 'sidebar/4.png' ),
		);
		$def['post_layouts'] = array(
			'1' => array( 'img' => $admin_images . 'article/1.png' ),
			'2' => array( 'img' => $admin_images . 'article/2.png' ),
			'3' => array( 'img' => $admin_images . 'article/3.png' ),
			'4' => array( 'img' => $admin_images . 'article/4.png' ),
			'5' => array( 'img' => $admin_images . 'article/5.png' ),
		);
        $def['posts_medium'] = array(
            'medium1'	=> array( 'img' => $admin_images . 'post/1.png' ),
		);
        $def['posts_list'] = array(
            'list1'		=> array( 'img' => $admin_images . 'post/6.png' ),
            'list2'		=> array( 'img' => $admin_images . 'post/9.png' ),
		);
        $def['posts_group'] = array(
            'group1' => array( 'img' => $admin_images . 'group/1.png' ),
            'group2' => array( 'img' => $admin_images . 'group/2.png' ),
            'group3' => array( 'img' => $admin_images . 'group/3.png' ),
            'group4' => array( 'img' => $admin_images . 'group/4.png' ),
		);
        $def['posts_grouphero'] = array(
            'group1' => array( 'img' => $admin_images . 'grouphero/1.png' ),
            'group2' => array( 'img' => $admin_images . 'grouphero/2.png' ),
            'group3' => array( 'img' => $admin_images . 'grouphero/3.png' ),
            'group4' => array( 'img' => $admin_images . 'grouphero/4.png' ),
		);
        $def['posts_selective'] = array_merge(
            $def['posts_medium'],
            $def['posts_list'],
            array(
                'hero'	=> array( 'img' => $admin_images . 'post/hero.png' ),
            )
		);
        $def['posts_small'] = array(
            'small1'		=> array( 'img' => $admin_images . 'post/6.png' ),
            'small2'		=> array( 'img' => $admin_images . 'post/9.png' ),
		);
        $def['posts_tax'] = array(
            'tax1'	=> array( 'img' => $admin_images . 'post/1.png' ),
            'tax2'	=> array( 'img' => $admin_images . 'post/2.png' ),
            'tax3'	=> array( 'img' => $admin_images . 'post/3.png' ),
            'tax4'	=> array( 'img' => $admin_images . 'post/4.png' ),
            'tax5'	=> array( 'img' => $admin_images . 'post/5.png' ),
		);
		$def['grid_columns'] = array(
			'1' => '1 Column',
			'2' => '2 Columns',
			'3' => '3 Columns',
			'4' => '4 Columns',
			'6' => '6 Columns',
            'custom' => 'Custom',
		);
		$def['skins'] = array(
			'light' => array( 'img' => $admin_images . 'skin/light.png' ),
			'dark'  => array( 'img' => $admin_images . 'skin/dark.png' ),
		);
        $def['skins_section'] = array(
			'light' => array( 'img' => $admin_images . 'skin/light.png' ),
			'dark'  => array( 'img' => $admin_images . 'skin/dark.png' ),
            'inherit'  => array( 'img' => $admin_images . 'skin/inherit.png' ),
		);
        $def['skins_elementor'] = array(
			'light' => array( 'img' => $admin_images . 'skin/light.png' ),
			'dark'  => array( 'img' => $admin_images . 'skin/dark.png' ),
		);
		$def['heading_sizes'] = array(
			'h1' => 'H1',
			'h2' => 'H2',
			'h3' => 'H3',
			'h4' => 'H4',
			'h5' => 'H5',
			'h6' => 'H6',
		);
        $def['btn_content'] = array(
			'icon'  => 'Icon Only',
			'text'  => 'Text Only',
			'icon_text' => 'Icon & Text',
		);
		$def['btn_size'] = array(
			'tiny'  => 'Tiny',
			'small'  => 'Small',
			'medium' => 'Medium',
			'large'  => 'Large',
		);
		$def['btn_radius'] = array(
            'default'  => 'Default',
			'square'  => 'Square',
			'radius'  => 'Radius',
			'rounded' => 'Rounded',
            'circle' => 'Circle',
            'elipse' => 'Elipse',
		);
		$def['btn_style'] = array(
            'default' => 'Default Button',
            'white' => 'White Button',
			'black' => 'Black Button',
            'accent' => 'Colored Button',
            'text'       => 'Simple',
			'text_color' => 'Colored Simple',
		);
		$def['social_style'] = array(
            'simple' => 'Simple',
            'color' => 'Basic Colored',
			'circle'  => 'Circle',
		);
		$def['post_infos'] = array(
			'first_cat' => 'First Category',
			'author'    => 'Author',
			'date'      => 'Date',
			'comments'  => 'Comment number',
            'review' => 'Review',
            'readmore' => 'Read More',
		);
        $def['post_infos_single'] = array(
            'author' => 'Author',
            'date' => 'Date',
            'comments' => 'Comment number',
            'last_update' => 'Last Update',
            'reading_time' => 'Reading time',
		);
        $def['post_sort'] = array(
			'date'     => esc_html__( 'Latest', 'atlas' ),
			'rand'     => esc_html__( 'Random', 'atlas' ),
			'popular'  => esc_html__( 'Most Commented', 'atlas' ),
			'modified' => esc_html__( 'Last Modified', 'atlas' ),
		);
        $def['post_sort']['best'] = esc_html__( 'Best Reviews', 'atlas' );
        $def['post_infos']['review'] = 'Review';
        $def['post_infos_single']['review'] = 'Review';
        if ( TH90_POSTVIEWS_IS_ACTIVE ) {
            $def['post_sort']['views'] = esc_html__( 'Most Viewed', 'atlas' );
            $def['post_infos']['views'] = 'Views number';
            $def['post_infos_single']['views'] = 'Views number';
        }

		$def['info_position'] = array(
			'top'    => 'Top',
			'under'  => 'Under Title',
			'bottom' => 'Bottom',
		);
		$def['info_styles'] = array(
			'classic' => 'Classic',
			'modern'  => 'Modern',
		);
		$def['image_ratio'] = array(
            'custom' => 'Custom',
			'ori' => 'Original',
			'1_1' => '1:1 (square)',
			'16_9' => '16:9 (Panoramic)',
			'3_2' => '3:2 (Rectangle)',
			'4_3' => '4:3 (Rectangle)',
			'2_1' => '2:1 (Landscape)',
			'4_5' => '4:5 (portrait)',
			'2_3' => '2:3 (portrait)',
			'3_4' => '3:4 (portrait)',
		);
		$def['first_cat_loc'] = array(
            'title'     => 'Above title',
			'default'   => 'On post info',
			'thumbnail' => 'On thumbnail',
		);
        $def['cats_style'] = array(
            'text' => 'Text',
            'btn' => 'Button',
        );
        $def['hover_styles'] = array(
            'default'              => 'Default',
            'color'                => 'Colored',
            'underline'            => 'Underline',
            'underline_color'      => 'Colored underline',
            'underline_text_color' => 'Colored underline & text',
        );

        $def['social_shares'] = array(
            'facebook' => 'Facebook',
            'twitter' => 'Twitter',
            'pinterest' => 'Pinterest',
            'telegram' => 'Telegram',
            'linkedin' => 'Linkedin',
            'tumblr' => 'Tumblr',
            'reddit' => 'Reddit',
            'vkontakte' => 'VKontakte',
            'whatsapp' => 'Whatsapp',
            'email' => 'Email',
        );
        $def['social_counters'] = array(
            'facebook'   => 'Facebook',
            'twitter'    => 'Twitter',
            'instagram'  => 'Instagram',
            'twitch'     => 'Twitch',
            'youtube'    => 'Youtube',
            'pinterest'  => 'Pinterest',
            'linkedin'   => 'Linkedin',
            'tiktok'     => 'Tiktok',
            'github'     => 'Github',
            'whatsapp'   => 'Whatsapp',
            'reddit'     => 'Reddit',
        );
        $def['social_networks'] = array(
            'facebook'   => 'Facebook',
            'twitter'    => 'Twitter',
            'instagram'  => 'Instagram',
            'linkedin'   => 'Linkedin',
            'youtube'    => 'Youtube',
            'pinterest'  => 'Pinterest',
            'github'     => 'Github',
            'twitch'     => 'Twitch',
            'tiktok'     => 'Tiktok',
            'tumblr'     => 'Tumblr',
            'telegram'   => 'Telegram',
            'behance'    => 'Behance',
            'dribbble'   => 'Dribbble',
            'skype'      => 'Skype',
            'soundcloud' => 'Soundcloud',
            'flickr'     => 'Flickr',
            'snapchat'   => 'Snapchat',
            'digg'       => 'Digg',
            'vimeo'      => 'Vimeo',
            'reddit'     => 'Reddit',
            'vkontakte'  => 'VKontakte',
            'whatsapp'   => 'Whatsapp',
            'medium'     => 'Medium',
            'deviantart' => 'Deviantart',
            'website'    => 'Website',
            'rss'        => 'RSS',
        );
        $def['reset_gradient'] = array(
            'from'    => '',
            'to'      => '',
        );
        $def['ipsum_text'] = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus libero libero, ultrices varius molestie eget, convallis a dui. Donec in eleifend erat.';

        return array_merge( $def, th90_default_redux() );
	}
}
