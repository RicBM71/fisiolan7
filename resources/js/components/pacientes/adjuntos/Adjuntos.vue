
<template>

    <div>
        <v-data-table
            :options="options"
            :headers="headers"
            :items="adjuntos"
        >
            <template v-slot:item.descripcion="props">
                <v-edit-dialog
                    :return-value.sync="props.item.descripcion"
                    @save="save(props.item)"
                > {{ props.item.descripcion }}
                <template v-slot:input>
                    <v-text-field
                    v-model="props.item.descripcion"
                    label="Editar"
                    single-line
                    counter
                    ></v-text-field>
                </template>
                </v-edit-dialog>
            </template>
            <template v-slot:item.actions="{ item }">
                <v-icon
                    small
                    @click="openItem(item.id)"
                >
                    mdi-card-search
                </v-icon>
                <v-icon
                    small
                    @click="deleteItem(item)"
                >
                    mdi-delete
                </v-icon>
            </template>
            <template v-slot:item.created_at="{ item }">
                {{ formatDate(item.created_at)}}
            </template>
            <template v-slot:item.username="{ item }">
                {{ item.username + " " + formatDateTime(item.updated_at)}}
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
        adjuntos: Array
    },
    data () {
      return {
        options:{
            itemsPerPage: 8,
            sortDesc: [true],
            sortBy: ['created_at'],
        },
        headers: [
            {
                text: 'Fecha',
                align: 'left',
                value: 'created_at',
                width: '10%'
            },
            {
                text: 'Descripción',
                align: 'left',
                value: 'descripcion',
                width: '60%'
            },
            {
                text: 'Usuario',
                align: 'left',
                value: 'username',
                width: '20%'
            },
            {
                text: 'Acciones',
                align: 'Center',
                value: 'actions',
            }
        ],
        items:[],
        ruta: "adjunto"
      }
    },
    mounted()
    {

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
        openItem (id) {

            var url = '/mto/adjuntos/'+id;

            window.open(url, '_blank');
        },
        save(item){

            var url = '/mto/adjuntos';
            axios.put(url+"/"+item.id, {descripcion:item.descripcion})
                .then(res => {

                })
                .catch(err => {
                    this.$toast.error(err.response.data.message);
                })
                .finally(()=> {
                });
        },
        deleteItem(item){

            if (confirm('¿Estás seguro de borrar el fichero?')) {
                var url = '/mto/adjuntos/'+item.id;
                axios.post(url,{_method: 'delete'})
                    .then(response => {
                        const index = this.adjuntos.indexOf(item);
                        this.adjuntos.splice(index, 1);
                        this.$toast.success('Registro eliminado!');
                    })
                    .catch(err => {
                        var msg = err.response.data.message;
                        this.$toast.error(msg);

                    });
            }

        }
    }
  }
</script>
