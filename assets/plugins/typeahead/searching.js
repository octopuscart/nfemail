$(document).ready(function(){
    //Customer name search
    var customers = new Bloodhound({
      datumTokenizer: Bloodhound.tokenizers.obj.whitespace('fullname'),
      queryTokenizer: Bloodhound.tokenizers.whitespace,
      remote: "../../views/customerManagement/customerSearch.php?searchText=%QUERY",
    });
 
  
    customers.initialize(); // customer mobile search init

    
    //// Search Customer type ahead //////////////////////////////////////////////////
    $('#searchCustomer').typeahead( {
                          highlight: true,
                          onselect: function(obj) { console.log(obj) },
                        },
                        {
                          name: 'customers',
                          displayKey: 'fullname',
                          source: customers.ttAdapter(),
                          templates: {
              header: '<b class="typeaheadgroup text-primary"><i class="fa fa-user"></i>&nbsp;Customers</b>',
                             
                                      },
            
                        }).bind('typeahead:selected', function(obj, datum) {
                                                                         
                                                                         for(i in datum){$("#"+i).html('');}  
                                                                         for(i in datum){
                                                                             $("#"+i).html(datum[i]);
                                                                             $("#"+i).val(datum[i])
                                                                         }
                                                                         $("#customer_image").attr("src", "");
                                                                         $("#customer_image").attr("src", "../../static/images/customer_images/"+datum['image']);
                                                                         
                                                                         //window.location =  pathname+"/callEntry/00/"+datum.id;
                                                                        });
        $("#instantCall").on('hidden.bs.modal', function (e) { });
       /////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
});
    
    
