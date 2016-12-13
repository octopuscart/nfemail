/*   
Template Name: Color Admin - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.5
Version: 1.8.0
Author: Sean Ngu
Website: http://www.seantheme.com/color-admin-v1.8/admin/
*/

var handleDataTableScroller = function() {
	"use strict";
    
    if ($('#data-table').length !== 0) {
        $('#data-table').DataTable( {
            ajax:           "assets/plugins/DataTables/json/scroller-demo.json",
            deferRender:    true,
            dom:            "frtiS",
            scrollY:        320,
            scrollCollapse: true
        });
    }
};

var TableManageScroller = function () {
	"use strict";
    return {
        //main function
        init: function () {
            handleDataTableScroller();
        }
    };
}();