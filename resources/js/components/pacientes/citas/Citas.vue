
<template>

    <div>
        <v-data-table
            :options="options"
            :headers="headers"
            :items="citas"
            show-expand
            dense
        >
            <template v-slot:item.actions="{ item }">
                <v-icon
                    small
                    @click="editItem(item.id)"
                >
                    mdi-pencil
                </v-icon>
            </template>
            <template v-slot:item.estado="{ item }">
                <span :class="item.estado.color">{{ item.estado.nombre}}</span>
            </template>
            <template v-slot:item.fecha="{ item }">
                {{ formatDate(item.fecha)}}
            </template>
            <template v-slot:item.username="{ item }">
                {{ item.username + " " + formatDateTime(item.updated_at)}}
            </template>
            <template v-slot:expanded-item="{ headers, item }">
            <td :colspan="headers.length">{{ item.notas }}</td>
            </template>
        </v-data-table>
    </div>

</template>
<script>
import moment from 'moment'
import {mapGetters} from 'vuex'
  export default {
    $_veeValidate: {
        validator: 'new'
    },
    props:{
        citas: Array
    },
    data () {
      return {
        options:{
            itemsPerPage: 10,
            sortDesc: [true],
            sortBy: ['fecha','hora'],
        },
        headers: [
            {
                text: 'Fecha',
                align: 'left',
                value: 'fecha',
            },
            {
                text: 'Hora',
                align: 'left',
                value: 'hora',
            },
            {
                text: 'Fisio',
                align: 'left',
                value: 'facultativo.nombre',
            },
            {
                text: 'Tratamiento',
                align: 'left',
                value: 'tratamiento.nombre',
            },
            {
                text: 'Importe',
                align: 'left',
                value: 'importe',
            },
            {
                text: 'Bono',
                align: 'left',
                value: 'bono',
            },
            {
                text: 'Factura',
                align: 'left',
                value: 'factura',
            },
            {
                text: 'Estado',
                align: 'left',
                value: 'estado',
            },
            {
                text: 'Usuario',
                align: 'left',
                value: 'username',
            },
            {
                text: 'Acciones',
                align: 'Center',
                value: 'actions',
            },
            { text: '', value: 'data-table-expand' },
        ],
        items:[],
        ruta: "citas"
      }
    },
    mounted()
    {

        //console.log('historia');
        // axios.get(this.url)
        //     .then(res => {

        //         this.items = res.data;

        //     })
        //     .catch(err =>{

        //         this.$toast.error(err.response.data.message);
        //         this.$router.push({ name: 'dash' })
        //     })
        //     .finally(()=>{
        //         this.show_loading = false;
        //     });
    },
    computed: {
        ...mapGetters([
            'isAdmin',
        ])
    },
    methods:{
        formatDate(f){
            if (f == null) return null;
            moment.locale('es');

            return moment(f).format('DD/MM/YYYY');

        },
        formatDateTime(f){
            if (f == null) return null;
            moment.locale('es');

            return moment(f).format('DD/MM/YYYY H:mm:ss');

        },
        create(){
            this.$router.push({ name: this.ruta+'.create'})
        },
        editItem (id) {
            this.$router.push({ name: this.ruta+'.edit', params: { id: id } })
        },
    }
  }
</script>

