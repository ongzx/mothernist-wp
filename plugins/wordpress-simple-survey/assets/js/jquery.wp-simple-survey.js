/*!
 *  WordPress Simple Survey JavaScript Library v3.0.0
 *
 *  @version 3.0.1
 *  @copyright 2012, 2013, 2014, SAI Digital
 *  @author Richard Royal
 *  @license see EULA
 */
(function( $ ) {
  $.fn.WP_Simple_Survey = function(args) {

    var settings = $.extend({
      'selector'       : this.selector,
    }, args);

    settings.selector = this.selector;
    settings.current = 1;
    var wpss = $(this);
    var current = 1;
    var quiz_id = $(this).data('quiz-id');
    var wpss_id = "#wpss_quiz_" + quiz_id;
    var question_count = parseInt( $(this).data('question-count') );
    var answered_panels = []


    /************************************************************/
    /* Next Button Click Handler                                */
    /************************************************************/
    $(".wpss_next", wpss_id).click(function(e) {  
      e.preventDefault();    
      if( !$(this).hasClass('wpss_disabled') && !$(this).hasClass('wpss-fields-panel') ){

        panel = '.wpss_panel_' . concat( current );
        $( panel, wpss_id ).fadeTo(0,1).hide(0);
  
        current+=1;
        panel = '.wpss_panel_' . concat( current );
        $( panel, wpss_id ).fadeIn('fast');
  
        $(".wpss_back", wpss_id).removeAttr("disabled").removeClass('wpss_disabled');
  
  
        if( $(panel, wpss_id).hasClass('wpss-fields-panel') ){
          $(".wpss_next", wpss_id).attr("disabled", "disabled").addClass('wpss_disabled');
        } else {
          if( $.inArray(panel, answered_panels) < 1 ){
            $(".wpss_next", wpss_id).attr("disabled", "disabled").addClass('wpss_disabled');
          }
        }

        $(".wpss-progress-bar span", wpss_id).css('width', 100*(current-1)/question_count  + '%');

      }
    });      


    /************************************************************/
    /* Back Button Click Handler                                */
    /************************************************************/
    $(".wpss_back", wpss_id).click(function(e) {
      e.preventDefault();
      if( !$(this).hasClass('wpss_disabled') ){
      
        panel = '.wpss_panel_' . concat( current );
        $( panel, wpss_id ).fadeTo(0,1).hide(0);
  
        current-=1;
        panel = '.wpss_panel_' . concat( current );
        $( panel, wpss_id ).fadeIn('fast');
  
        $(".wpss_next", wpss).removeAttr("disabled").removeClass('wpss_disabled');
  
        if(current <= 1){
          $(".wpss_back", wpss_id).attr("disabled", "disabled").addClass('wpss_disabled');
          current = 1;
        }

        $(".wpss-progress-bar span", wpss_id).css('width', 100*(current-1)/question_count  + '%');

      }
    });


    /************************************************************/
    /* Next button enable handler                               */
    /************************************************************/
    $("input[type='radio'], input[type='checkbox'], select", wpss_id).change(function() {          
      panel = '.wpss_panel_' . concat( current );
      if( !$(panel, wpss_id).hasClass('wpss-fields-panel') ){
        if( $.inArray( panel, answered_panels ) == -1 ){
          answered_panels.push( panel );
        }
        $(".wpss_next", wpss_id).removeAttr("disabled").removeClass('wpss_disabled');
      }
    });

    $("textarea, input[type='text']", wpss_id).keydown(function() {
      panel = '.wpss_panel_' . concat( current );
      if( !$(panel, wpss_id).hasClass('wpss-fields-panel') ){
        if( $.inArray( panel, answered_panels ) == -1 ){
          answered_panels.push( panel );
        }
        $(".wpss_next", wpss_id).removeAttr("disabled").removeClass('wpss_disabled');
      }
    });

  }
}( jQuery ));
