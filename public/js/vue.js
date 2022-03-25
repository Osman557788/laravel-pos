
const app = new Vue({
    el: '#app',

    mounted:function(){

        this.getCategories() ;
        // this.printorders() ;

    },

    data() {
        return { 
          categories : [],
          order :[],
          orders :[],  
          total : 0 
        }
      },

    methods:{

        getCategories:function(){

            axios.get('http://localhost:8000/dashboard/products')
            
            .then((respons) => {

                respons.data.forEach((element) => {

                    element.products.forEach((product)=>{
                        product.disblay = false ;
                        product.quntity = 1 ;
                        product.index = respons.data.indexOf(element) ;
                        product.index1 = element.products.indexOf(product) ;
                    });
                    
                });
                
                this.categories = respons.data ;    

            });

            

        },

        getOrder:function(product){
            
            this.orders.push(product); 
            product.disblay = !product.disblay
            this.totalPrice();
            
        },

        removeFromList:function(productremove){

           
            this.categories[productremove.index].products[productremove.index1].disblay = false;
        
            index = this.orders.indexOf(productremove);
            this.orders.splice(index , 1);

            this.totalPrice();
            
        },

        totalPrice:function(){

            total = 0 ;
            
            this.orders.forEach((element)=>{

                total = total + element.sale_price * element.quntity ;

            });
            
            return total ;
        },

        submitForm:function(id){

            var product = new Object();
            this.orders.forEach((element)=>{
              
                var array = {};
                array.quntity = element.quntity ;
                product[element.id] = array;
                // console.log(x);
                
            });
            axios.post('/dashboard/clients/'+ id +'/orders', {
                products: product,
                _token:document.querySelector('meta[name="csrf-token"]').content
              })
              .then(function (response) {
                window.location.replace("/dashboard/orders");
              })
              .catch(function (error) {
                console.log(error);
              });

        }


        

    }
});
