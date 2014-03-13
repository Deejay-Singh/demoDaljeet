  jQuery(document).ready(function () {
    jQuery("#ResetPassword, #addAttributeForm, #addProductForm, #awbForm, #awb, #OrderForm, #productImages, #submitPick, #submitqcfail, #addAwbForm, #changeAwbForm, #reportForm, #inventory, #channelType").validate();
    jQuery(".datepicker").datepicker({dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true, minDate: new Date });
  });

    jQuery(document).ready(function () {
            jQuery.validator.addMethod("alphabet", function(value, element) {
                return this.optional(element) || /^[a-z \s]+$/i.test(value);
            }, "Please enter only Alphabet.");
      jQuery('#UserSignupForm').validate({
        rules: {
          confirm_password: {
            equalTo: "#password"
          }
        },
        messages: {
          user_pass: {
            minlength: "Short passwords are easy to guess. Try one with at least 5 characters."
          },
          confirm_password: {
            required: "Confirm your password here.",
            equalTo: "These passwords don't match. Try again?"
          },
          email: "Please enter a valid email address",          
          mobile: {
            number:"please enter a valid mobile number"
          },
          pin: {
            number:"please enter a valid pin number"
          }
        }
      });
      jQuery('#addchannelForm').validate({
        rules: {
          confirm_password: {
            equalTo: "#userpass"
          }
        },
        messages: {
          confirm_password: {
            required: "Confirm your password here.",
            equalTo: "These passwords don't match. Try again?"
          }
          }
        });
      jQuery('#createPicklist').validate({ rules: { 'productId[]': { required: true } }, messages: { 'productId[]': { required: "Please check atleast one product for picklist." } } }); });
    jQuery(document).ready( function(){
        jQuery('.jquery_action_users').click( function(){
            var buttonId = jQuery(this).attr('id');
            var d = buttonId.split('_');
            var id = d[1];
            var controller= d[2];
            var is_active= jQuery(this).attr('rel');
            if( d[3] ) {
                is_active +='/'+d[3];
            }
            var setUrl = '/'+controller+'/setstatus/'+ id + '/'+ is_active;
            jQuery.ajax({
                type: "GET",
                url: setUrl,
                success: function(data) {
                    if( data == '0' ) {
                        jQuery('#' + buttonId).removeClass('btn-success').addClass('btn-danger').text('Deactivate').attr('rel', '0');
                        jQuery('#span_'+ id).removeClass('label-important').addClass('label-success').text('YES');
                        jQuery('#status_class_'+ id).removeClass().addClass('label label-info').text('IN PROCESS');
                    } else if( data == '1' ) {
                        jQuery('#' + buttonId).removeClass('btn-danger').addClass('btn-success').text('Activate').attr('rel', '1');
                        jQuery('#span_'+ id).removeClass('label-success').addClass('label-important').text('NO');
                    } else {
                        jQuery('#flashMessage').show().addClass('alert alert-error').text(data);
                    }
                }
            });
        });
    
    jQuery('#loginDetails').hide();
    jQuery('#logininfo').click(function() { jQuery('#logininfo').hide(); jQuery('#loginDetails').slideDown("slow"); });
        jQuery('#login_hide').click(function() {jQuery('#loginDetails').slideUp("slow"); jQuery('#logininfo').show();});    

    jQuery('.attr-popup').click(function() {
      var id = jQuery(this).attr('id');
            var attrUrl = '/attributes/attrValues/';
            jQuery.ajax({
        type: "GET", url: attrUrl + id, success: function(data) { jQuery('#modal-body').empty().html( data ); }
      }) ;
    });
    
    jQuery('#submit-skin').click(function() {
		var skin = $("input[type='radio'].skinbtn:checked").val();
        var skinUrl = '/dashboard/skin/';
        jQuery.ajax({
			type: "GET", url: skinUrl + skin, success: function(data) { if(data==1){location.reload();}}
		}) ;
    });
    
    jQuery('#submit-skin-default').click(function() {
		var skin = '0';
        var skinUrl = '/dashboard/skin/';
        jQuery.ajax({
			type: "GET", url: skinUrl + skin, success: function(data) { if(data==1){location.reload();}}
		}) ;
    });
    
    jQuery('.product-attr').click(function() {
      var id = jQuery(this).attr('id');
            var attrUrl = 'products/productAttr/';
            jQuery.ajax({ type: "GET", url: attrUrl + id, success: function(data) { jQuery('#modal-body').empty().html( data ); }}) ;
    });
    
    jQuery( '.dispatch' ).live( 'click', function() {
			var ids = jQuery(this).attr('rel');
			var d = ids.split('^');
			var orderId = d[0];
			var manifestId = d[1];
            var setUrl = '/manifests/dispatch/';
            jQuery.ajax({ type: "GET", url: setUrl + orderId + '/' + manifestId, success: function(data) {
					jQuery( '#span' + orderId ).empty().html('<span class="badge label-success">Dispatched</span>'); 
					jQuery( '#dispatchCancel' + orderId ).empty().html( '<span class="badge">NA</span>' );
					jQuery( '#manifestFlagtext' ).val( parseInt( jQuery( '#manifestFlagtext' ).val() ) - 1 );
					if( jQuery( '#manifestFlagtext' ).val() == '0' ) jQuery( '#manifestSubmit' ).removeClass( 'hide' );
				}
			});
		});
		
		jQuery( '.cancel' ).live( 'click', function() {
			var ids = jQuery(this).attr('rel');
			var d = ids.split('^');
			var orderId = d[0];
			var manifestId = d[1];
            var setUrl = '/manifests/cancel/';
            jQuery.ajax({ type: "GET", url: setUrl + orderId + '/' + manifestId, success: function(data) {
					jQuery( '#span' + orderId ).empty().html('<span class="badge label-danger">Cancelled</span>'); 
					jQuery( '#dispatchCancel' + orderId ).empty().html( '<span class="badge">NA</span>' ); 
					jQuery( '#manifestFlagtext' ).val( parseInt( jQuery( '#manifestFlagtext' ).val() ) - 1 );
					if( jQuery( '#manifestFlagtext' ).val() == '0' ) jQuery( '#manifestSubmit' ).removeClass( 'hide' );
				}
			});
		});
		
		jQuery( '.closeManifest' ).live( 'click', function() {
			var manifestId = jQuery(this).attr('rel');
            var setUrl = '/manifests/closeManifest/';
            jQuery.ajax({ type: "GET", url: setUrl + manifestId, success: function(data) {
					jQuery( '#manifestStatus' ).empty().html('Closed');
					jQuery( '#manifestSubmit' ).hide();
				}
			});
		});

    jQuery('.delete-attr').live("click", function() {
      var deleteUrl = 'attributes/delete/';
      var attrId = jQuery(this).attr('id');
      jQuery.ajax({type:"GET",url:deleteUrl + attrId,success: function(data){jQuery('#tr_' + attrId ).fadeOut();}});});

        jQuery('#attr_code').change(function () { jQuery('#attr_code_hidden').val( jQuery('#attr_code').val() );}).trigger('change');
    jQuery('.attrValueRemove').live("click", function() {jQuery(this).parent().remove();});
      jQuery( '#flashMessage' ).click(function() {jQuery( '#flashMessage' ).hide();});
      jQuery(window).scroll(function(){if (jQuery(this).scrollTop() > 100) {jQuery('.scrollup').fadeIn();}else{jQuery('.scrollup').fadeOut();}});
      jQuery('.scrollup').click(function(){jQuery("html, body").animate({ scrollTop: 0 }, 600);return false;});

      jQuery('#attrOptionDiv').change(function() {
      for (var i = 0; i < jQuery('#attrOptionDiv').val(); i++) {jQuery('.copyAttr').clone().removeClass().appendTo('.addAttr');}
      jQuery('#attrOptionDiv').val('');
    });
    
      jQuery('.cancel-order').live( 'click', function() {
      var cancelUrl = '/orders/setStatus/';
      var buttonId = jQuery(this).attr('id');
            var d = buttonId.split('_');
            var orderId = d[1];
            jQuery.ajax({ type: "GET", url: cancelUrl + orderId, success: function(data) { jQuery('#span_' + orderId).empty().addClass('badge badge-info').html('Cancelled'); jQuery('#invoiceButton_' + orderId).empty().html('<span class="badge" >Cancelled</span>'); } });
    });
    
      jQuery('.selectAll').live( 'click', function() { jQuery('.select').prop('checked', jQuery(this).is(':checked')); });
      
      jQuery('.select').live( 'click', function() { if ( !jQuery( this ).is( ':checked' ) ) jQuery( '.selectAll' ).prop( 'checked', false ); });
      
      jQuery('.pick-product').live( 'click', function() {
      var id = jQuery( this ).attr('id');
      var d = id.split('-');
      var picklistkey = d[1];
      var rel = jQuery( this ).attr('rel');
      var r = rel.split('-');
      var id = r[1];
      var setUrl = '/picklists/update/';
      jQuery.ajax({ type: "GET", url: setUrl + picklistkey + '/' + id + '/' + '1', success: function(data) {
          jQuery( '#span-' + picklistkey).empty().html('<span class="badge badge-info" >Picked</span>');
          jQuery( '#status-' + picklistkey).empty().html('Picked');
          jQuery( '#cancelspan-' + picklistkey).empty().html('<span class="badge" >N.A</span>');
          jQuery( '#picklistQuantityFlag' ).val( parseInt( jQuery( '#picklistQuantityFlag' ).val() ) - 1 );
          if( jQuery( '#picklistQuantityFlag' ).val() == '0' ) jQuery( '#pickSubmit' ).removeClass( 'hide' );
        }
      });
    });
    
      jQuery('.cancel-product').live( 'click', function() {
      if( !confirm("Are You Sure this product is not available?" ) ) return false;
            else {
        var id = jQuery( this ).attr('id');
        var d = id.split('-');
        var picklistkey = d[1];
        var rel = jQuery( this ).attr('rel');
        var r = rel.split('-');
        var id = r[1];
        var setUrl = '/picklists/update/';
        jQuery.ajax({ type: "GET", url: setUrl + picklistkey + '/' + id + '/' + '0', success: function(data) {
            jQuery( '#span-' + picklistkey).empty().html('<span class="badge" >N.A</span>');
            jQuery( '#status-' + picklistkey).empty().html('Na');
            jQuery( '#cancelspan-' + picklistkey).empty().html('<span class="badge badge-info" >Canceled</span>');
            jQuery( '#picklistQuantityFlag' ).val( parseInt( jQuery( '#picklistQuantityFlag' ).val() ) - 1 );
            if( jQuery( '#picklistQuantityFlag' ).val() == '0' ) jQuery( '#pickSubmit' ).removeClass( 'hide' );
          }
        });
      }
    });
    
    jQuery('.quality-product-popup').live( 'click', function() {
      var id = jQuery( this ).attr('id');
      var d = id.split('-');
      var key = d[1];
      var d = key.split('_');
      var productId = d[0];
      var setUrl = '/quality/productView/';
      jQuery.ajax({ type: "GET", url: setUrl + productId, success: function(data) { jQuery( '#modal-body' ).empty().html(data).animate({ scrollTop: 0 }, 600); } });
    });
    
    jQuery('.qc-pass').live( 'click', function() {
      var id = jQuery( this ).attr('id');
      var d = id.split('-');
      var qckey = d[1];
      var rel = jQuery( this ).attr('rel');
      var r = rel.split('-');
      var id = r[1];
      var setUrl = '/quality/update/';
      jQuery.ajax({ type: "GET", url: setUrl + qckey + '/' + id, success: function(data) {
          jQuery( '#row-' + qckey).addClass( 'success' );
          jQuery( '#action-' + qckey).empty().html('<span class="badge" >N.A</span>');          
          jQuery( '#qualityQuantityFlag' ).val( parseInt( jQuery( '#qualityQuantityFlag' ).val() ) - 1 );
          if( jQuery( '#qualityQuantityFlag' ).val() == '0' ) jQuery( '#qualityListClose' ).removeClass( 'hide' );
        }
      });
    });
    
    jQuery('.qc-fail').live( 'click', function() {
      var id = jQuery( this ).attr('id');
      var d = id.split('-');
      var picklistkey = d[1];
      jQuery('#key').val('').val( picklistkey );
      var rel = jQuery( this ).attr('rel');
      var r = rel.split('-');
      var id = r[1];
      jQuery('#qualityId').val('').val( id );
      jQuery('#reason').val('');
    });
    
    jQuery('#qualityListClose').click(function() {
      var id = jQuery( this ).attr( 'rel' );
      var setUrl = '/quality/closeList/';
      var redirectUrl = '/quality/index/';
      jQuery.ajax({ type: "GET", url: setUrl + id, success: function(data) { window.location.href = redirectUrl; } });
    });
    
    jQuery('#addrole').click(function() {
      jQuery('#addNewRole').hide();
      jQuery('#addNewRole').slideDown("slow");
    });
    
    jQuery('#controller').change(function() {
      var setUrl = '/roles/getaction/';
      var controller = jQuery('#controller').val();
      jQuery.ajax({ type: "GET", url: setUrl + controller, success: function(data) { jQuery('#action').empty().html( data ); } });
    });
    
      jQuery('.more-image').live( 'click', function() {
      if( jQuery('#imageLimit').val() < 10 ) {
        jQuery('.imageUploader').clone().removeClass('imageUploader hide').appendTo('.copyImageUploader');
        jQuery('#imageLimit').val( parseInt( jQuery('#imageLimit').val() ) + 1 );
      } else jQuery('#flashMessage').show().addClass('alert alert-error').text("You Can Upload max of 10 images.");
    });
    
    jQuery( "#date-from" ).datepicker({ defaultDate: "+1w", dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true, maxDate: new Date, onClose: function( selectedDate ) { jQuery( "#date-to" ).datepicker( "option", "minDate", selectedDate ); } });
    jQuery( "#date-to" ).datepicker({ defaultDate: "+1w", dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true, maxDate: new Date, onClose: function( selectedDate ) { jQuery( "#date-from" ).datepicker( "option", "maxDate", selectedDate ); } });
    
      jQuery('#fetch-audit').live( 'click', function() {
      var setUrl = '/audits/fetch/';
      var model = jQuery( '#model' ).attr( 'value' ) ? jQuery( '#model' ).attr( 'value' ) : null;
      var event = jQuery( '#event' ).attr( 'value' ) ? jQuery( '#event' ).attr( 'value' ) : null;
      var dateFrom = jQuery( '#date-from' ).attr( 'value' ) ? jQuery( '#date-from' ).attr( 'value' ) : null;
      var dateTo = jQuery( '#date-to' ).attr( 'value' ) ? jQuery( '#date-to' ).attr( 'value' ) : null;
      if( model == null && event == null && dateFrom == null && dateTo == null ) { alert('Please Select atleast one condition.'); return false; }
      jQuery('#displayAudit').empty().html( '<div class="progress progress-striped active"><div class="bar" style="width: 100%;"></div></div>' );
      jQuery.ajax({ type: "GET", url: setUrl + model + '/' + event + '/' + dateFrom + '/' + dateTo, success: function(data) { jQuery('#displayAudit').empty().html( data ); } });
    });
    
      jQuery('#fetch-rest-log').live( 'click', function() {
      var controller = jQuery( '#logsController' ).attr( 'value' ) ? jQuery( '#logsController' ).attr( 'value' ) : null;
      var setUrl = '/api/fetch/';
      var dateFrom = jQuery( '#date-from' ).attr( 'value' ) ? jQuery( '#date-from' ).attr( 'value' ) : null;
      var dateTo = jQuery( '#date-to' ).attr( 'value' ) ? jQuery( '#date-to' ).attr( 'value' ) : null;
      if( controller == null && dateFrom == null && dateTo == null ) { alert('Please Select atleast one condition.'); return false; }
      jQuery.ajax({ type: "GET", url: setUrl + dateFrom + '/' + dateTo + '/' + controller, success: function(data) { jQuery('#displayLog').empty().html( data ); } });
    });
    
    jQuery('.fetch-rest').live( 'click', function() {
      var id = jQuery(this).attr('id');
            var detailUrl = '/api/details/';
            jQuery.ajax({ type: "GET", url: detailUrl + id, success: function(data) { jQuery('#modal-body').empty().html( data ); }}) ;
    });
    
      jQuery('#changeAwbButton').live( 'click', function() {
      var setUrl = '/invoices/awbList/';
      jQuery.ajax({ type: "GET", url: setUrl, success: function(data) { jQuery('#awbData').empty().html( data ); } });
    });
    
      jQuery('#readyToShip').live( 'click', function() {
      var id = jQuery( this ).attr( 'rel' );
      var setUrl = '/shipments/setStatus/';
      jQuery.ajax({ type: "GET", url: setUrl + id, success: function(data) { jQuery('#readyToShip').hide(); } } );
    });
    
      jQuery('.transaction-audit').live( 'click', function() {
      var id = jQuery( this ).attr( 'id' );
      var d = id.split('^');
      jQuery('#propertyName').empty().html( d[0] );
      jQuery('#oldValue').empty().html(  d[1] );
      jQuery('#newValue').empty().html( d[2] );
    });
    
    jQuery('.selectSize').live( 'change', function() {
      var id = jQuery(this).attr('id');
      var value = jQuery(this).attr('value');
      var d = id.split('-');
      var key = d[1];
      keyCheck = parseInt( key ) + 1;
      var html = "<input type='text' class='required number span1' name='multiple[quantity][" + value + "]'>";
      var after = "<input type='button' id='addMore-" + key + "' value='Add More' class='btn btn-info addMore'>";
      jQuery( '#td-2-' + key ).empty().html( html );
      if($("#tr-" + keyCheck).length == 0) {
        jQuery( '#td-3-' + key ).empty().html( after );
      }
      
    });

    jQuery('.addMore').live( 'click', function() {
      var id = jQuery(this).attr('id');
      var d = id.split('-');
      var keyadd = d[1];
      jQuery( '#td-3-' + keyadd ).empty();
      if( keyadd != '1' ) jQuery( '#td-3-' + keyadd ).html("<button type ='button' class='btn removeSize' ><i class='icon-remove'></i></button>");
      newKey = parseInt( keyadd ) + 1;
      jQuery( '#tr-' + keyadd ).after( "<tr id='tr-" + newKey + "'><td id='td-1-" + newKey + "'></td><td id='td-2-" + newKey + "'></td><td id='td-3-" + newKey + "'></td></tr>");
      jQuery( '#td-1-' + newKey ).html("<select id='size-" + newKey + "' class='required selectSize span2' name='multiple[size][]'>");
      jQuery('#size-' + newKey ).html(jQuery( '#clone' ).html());
    });

    jQuery('.removeSize').live( 'click', function() { jQuery( this ).parent().parent().remove(); });
    
  });
  function editAttribute() {
    var attrType = jQuery('#type').val();
    jQuery('.opt').attr( 'disabled', 'disabled' );
    jQuery('.hide').slideUp( "slow" );    
    if( attrType == 'text' ) {
      jQuery('#valueDate').removeAttr('disabled');
      jQuery('#valueText').val('');
    } else if(  attrType == 'date' ) {
      jQuery('#valueDate').removeAttr('disabled');
      jQuery('#valueDate').val('');
    }
  }
  function printDiv( divName ) {
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
  }
