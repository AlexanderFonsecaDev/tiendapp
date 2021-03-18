require('./bootstrap');

import Vue from 'vue'
import VueSweetalert2 from 'vue-sweetalert2';
import products from './components/products.vue'
import sizes from './components/sizes.vue'
import marks from './components/marks.vue'

// If you don't need the styles, do not connect
import 'sweetalert2/dist/sweetalert2.min.css';

Vue.use(VueSweetalert2);


const app = new Vue({
    el: '#app',
    data: {
        view_product: true,
        view_mark: false,
        view_size: false,
        marks: [],
        sizes: []
    },
    components: {
        products,sizes,marks
    },
    mounted() {

        // Obtenemos las marcas registradas en el sistema
        let self = this
        axios.get('/api/marks')
            .then(function (response) {
                self.marks = response.data.data
            })

        // Obtenemos los tamaños registrados en el sistema

        axios.get('/api/sizes')
            .then(function (response) {
                self.sizes = response.data.data
            })

    },
    methods: {
        enable_view(value){
            if (value === 'product'){
                this.view_mark    = false
                this.view_size    = false
                this.view_product = true
            }else if (value === 'size'){
                this.view_mark    = false
                this.view_size    = true
                this.view_product = false
            }else{
                this.view_mark    = true
                this.view_size    = false
                this.view_product = false
            }
        }
    }
});
