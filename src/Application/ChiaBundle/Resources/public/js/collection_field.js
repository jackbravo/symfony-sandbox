(function( $ ){

    var methods = {
        init : function(options) {
            return this.each(function() {
                var data = $(this).data('collection_field');

                if (!data) {
                    var settings = {
                        'starting_index': 0
                    };

                    if (options) {
                        $.extend(settings, options);
                    }

                    settings.skeleton = $(".row-item", this).first().remove();
                    settings.target = this;
                    $(".add-field", this).bind("click.collection_field", methods.add_field);
                    $(".remove-field", this).bind("click.collection_field", methods.remove_field);

                    $(".add-field", this).data('collection_field', settings);
                    $(this).data('collection_field', settings);
                }
            });
        },
        add_field : function(event) {
            var settings = $(this).data('collection_field');
            var field = $(settings.skeleton).clone();
            field.html(function (i, oldhtml) {
                return oldhtml.replace(/\$\$key\$\$/g, settings.starting_index++);
            });
            $(".remove-field", field).bind("click.collection_field", methods.remove_field);
            $(".collection-field", settings.target).append(field);
            $(this).data('collection_field', settings);
            event.preventDefault();
        },
        remove_field : function(event) {
            var field = $(this).parent('.row-item').remove();
            event.preventDefault();
        },
        destroy : function( ) {
            return this.each(function(){
                $(this).unbind('.collection_field');
            })
        }
    };

    $.fn.collection_field = function(method) {
 
        // Method calling logic
        if (methods[method]) {
          return methods[method].apply(this, Array.prototype.slice.call(arguments, 1));
        } else if ( typeof method === 'object' || ! method ) {
          return methods.init.apply(this, arguments);
        } else {
          $.error('Method ' +  method + ' does not exist on jQuery.collection_field');
        }

    };
})( jQuery )
