const app1 = new Vue({
    el: '#orders',

    data() {
        return { 
          orderProducts:'',
          lauding:false,
          success:false,
        }
      },

    methods:{

        showOrder:function(id){

            this.lauding =!this.lauding;

            axios.get('http://localhost:8000/dashboard/orders/'+id)
            
            .then((respons) => {
                this.orderProducts = respons.data ;
                if(!this.success){

                    this.success = !this.success ;
                }
                
                this.lauding =!this.lauding;

            });

            

        },

        print:function(){
            
            $('#order-product-list').printThis();
        },

        getPorductsOrder:function(orderId){

            axios.get('http://localhost:8000/dashboard/orders/orderId')
            .then((respons) => {

                this.disblay = !this.disblay ;
                this.products = respons.data ;
                console.log(respons.log);
            });

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
              
                var array = {};
                array.quntity = element.quntity ;
                product[element.id] = array;
                // console.log(x);
                
            });

            console.log(product);

            axios.post('http://localhost:8000/dashboard/clients/1/orders', {
                product: x
              })
              .then(function (response) {
                console.log(response.data);
              })
              .catch(function (error) {
                console.log(error);
              });

        }


        

    }
});
