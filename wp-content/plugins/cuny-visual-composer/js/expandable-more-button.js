(function() {
   tinymce.create('tinymce.plugins.cuny_expandable_link', {
      init : function(ed, url) {
         ed.addButton('cuny_expandable_link', {
            title : 'Expandable More Link',
            icon : 'template',
            onclick : function() {
               var target_class = prompt("Target Element (class)", "more-target");

               if (target_class.length) {


                  selected_text = tinyMCE.activeEditor.selection.getContent();
                  if( !selected_text ) {
                     selected_text = 'Read More';
                  }
                  
                  tinymce.execCommand('mceInsertContent', false, '[cuny_expandable_link el_class="more" expanded_title="Read Less" target="' + target_class + '"]' + selected_text + '[/cuny_expandable_link]');
               }
            }
         });
      },
   
      createControl : function(n, cm) {
         return null;
      },
   
      getInfo : function() {
         return {
            longname : 'Expandable More Link',
            author : 'CUNY Office of Communications and Marketing',
            authorurl : 'http://www.cuny.edu',
            version : "1.0"
         };
      }
   });
   tinymce.PluginManager.add('cuny_expandable_link', tinymce.plugins.cuny_expandable_link);
})();