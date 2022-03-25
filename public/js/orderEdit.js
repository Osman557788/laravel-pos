
const edit = new Vue({
    el: '#edit',

    mounted:function(){
        this.getProductOfOrder() ;
        this.getCategories() ;
        
    },

    data() {
        return { 
          categories : [],
          order:[],
          orders:[],  
          total: 0 ,
          thisOrderProduct:[],
          quantityOfProducts:[],
        }
    },

    methods:{

        getCategories:function(){

            axios.get('http://localhost:8000/dashboard/products')
            
            .then((respons) => {

                respons.data.forEach((element) => {

                    element.products.forEach((product)=>{
                        if (this.thisOrderProduct.includes(product.id)) {
                            product.disblay = true ;
                            product.quntity = this.quantityOfProducts[product.id];
                            product.index = respons.data.indexOf(element) ;
                            product.index1 = element.products.indexOf(product) ;
                            this.orders.push(product);

                            
                        } else {
                            product.disblay = false ;
                            product.quntity = 1 ;
                            product.index = respons.data.indexOf(element) ;
                            product.index1 = element.products.indexOf(product) ;    
                        }
                        
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

        getProductOfOrder:function(){
            axios.get('http://localhost:8000/dashboard/order/'+window.location.pathname.toString().split("/")[3])
            .then((respons) => {
                
                respons.data.forEach(element => {
                    this.thisOrderProduct.push(element.id);
                    this.quantityOfProducts[element.id] = element.pivot.quntity ; 
                });
                //  console.log(this.thisOrderProduct
            });

            // console.log(window.location.href);
            // this.orders.push(product); 
            // product.disblay = !product.disblay
            // this.totalPrice();
            
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

        submitForm:function(){

            var product = new Object();
            this.orders.forEach((element)=>{

                console.log('http://localhost:8000/dashboard/orders/' + window.location.pathname.toString().split("/")[3]);
                var array = {};
                array.quntity = element.quntity ;
                product[element.id] = array;
                // console.log(x);
                
            });
            axios.put('http://localhost:8000/dashboard/orders/' + window.location.pathname.toString().split("/")[3], {
                products: product,
                _token:document.querySelector('meta[name="csrf-token"]').content,
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
