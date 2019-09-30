/*   
Template Name: Color Admin - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.5
Version: 1.8.0
Author: Sean Ngu
Website: http://www.seantheme.com/color-admin-v1.8/admin/
*/

var handleDataTableAutofill = function() {
	"use strict";
    
    if ($('#data-table').length !== 0) {
        var table = $('#data-table').DataTable();
        new $.fn.dataTable.AutoFill(table, {
            mode: 'both',
            complete: function ( altered ) {
                var last = altered[ altered.length-1 ];
            
                $.gritter.add({
                    title: 'Table Column Updated <i class="fa fa-check-circle text-success m-l-3"></i>',
                    text: altered.length+' cells were altered in this auto-fill. The value of the last cell altered was: <span class="text-white">'+last.oldValue+'</span> and is now <span class="text-white">'+last.newValue+'</span>',
                    sticky: true,
                    time: '',
                    class_name: 'my-sticky-class'
                });
            }
        });
    }
};

var TableManageAutofill = function () {
	"use strict";
    return {
        //main function
        init: function () {
            handleDataTableAutofill();
        }
    };
}();