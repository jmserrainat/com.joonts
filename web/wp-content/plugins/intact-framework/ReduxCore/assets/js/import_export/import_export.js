/*global redux_change, redux*/

(function( $ ) {
    "use strict";

    redux.field_objects = redux.field_objects || {};
    redux.field_objects.import_export = redux.field_objects.import_export || {};

    $( document ).ready(
        function() {
            redux.field_objects.import_export.init();
        }
    );

    redux.field_objects.import_export.init = function( selector ) {

        if ( !selector ) {
            selector = $( document ).find( '.redux-container-import_export' );
        }
        
        var parent = selector;
        if ( !selector.hasClass( 'redux-field-container' ) ) {
            parent = selector.parents( '.redux-field-container:first' );
        }
        
        if ( parent.hasClass( 'redux-field-init' ) ) {
            parent.removeClass( 'redux-field-init' );
        } else {
            return;
        }

        $( '#redux-import' ).click(
            function( e ) {
                if ( $( '#import-code-value' ).val() === "" && $( '#import-link-value' ).val() === "" ) {
                    e.preventDefault();
                    return false;
                }
                window.onbeforeunload = null;
            }
        );

        $( '#redux-import-code-button' ).click(
            function() {
                if ( $( '#redux-import-link-wrapper' ).is( ':visible' ) ) {
                    $( '#redux-import-link-wrapper' ).hide();
                    $( '#import-link-value' ).val( '' );
                }
                $( '#redux-import-code-wrapper' ).fadeIn( 'fast' );
            }
        );

        $( '#redux-import-link-button' ).click(
            function() {
                if ( $( '#redux-import-code-wrapper' ).is( ':visible' ) ) {
                    $( '#redux-import-code-wrapper' ).hide();
                    $( '#import-code-value' ).val( '' );
                }
                $( '#redux-import-link-wrapper' ).fadeIn( 'fast' );
            }
        );

        $( '#redux-export-code-copy' ).click(
            function() {
                if ( $( '#redux-export-link-value' ).is( ':visible' ) ) {
                    $( '#redux-export-link-value' ).hide();
                }
                $( '#redux-export-code' ).fadeIn( 'fast' );
            }
        );

        $( '#redux-export-link' ).click(
            function() {
                if ( $( '#redux-export-code' ).is( ':visible' ) ) {
                    $( '#redux-export-code' ).hide();
                }
                $( '#redux-export-link-value' ).fadeIn( 'fast' );
            }
        );

        var textBox1 = document.getElementById("redux-export-code");
        textBox1.onfocus = function() {
            textBox1.select();
            // Work around Chrome's little problem
            textBox1.onmouseup = function() {
                // Prevent further mouseup intervention
                textBox1.onmouseup = null;
                return false;
            };
        };
        var textBox2 = document.getElementById("import-code-value");
        textBox2.onfocus = function() {
            textBox2.select();
            // Work around Chrome's little problem
            textBox2.onmouseup = function() {
                // Prevent further mouseup intervention
                textBox2.onmouseup = null;
                return false;
            };
        };
        var urlVars = redux.field_objects.import_export.getUrlVars();
        if(urlVars.hasOwnProperty('import')) {
            a.post( "themes.php?page=import-demo&import", { url: decodeURIComponent(urlVars['import']) }, function( data ) {
                a('#import-loader').remove();
            });
        }

        a("#redux-form-wrapper").submit(function(event){
            event.preventDefault();
            var $this = this;
            var link = a("#import-link-value").val();
            a('input[name="_wp_http_referer"]').val(a('input[name="_wp_http_referer"]').val() + '&import=' + encodeURIComponent(link));
            a("#import-link-value").val( a("#import-link-value").val() + '/theme_options.json' );
            a($this).unbind('submit').submit();
        })
    };
    redux.field_objects.import_export.getUrlVars = function ()
    {
        var vars = [], hash;
        var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
        for(var i = 0; i < hashes.length; i++)
        {
            hash = hashes[i].split('=');
            vars.push(hash[0]);
            vars[hash[0]] = hash[1];
        }
        return vars;
    };
})( jQuery );