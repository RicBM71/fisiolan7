
<template>

    <div>
        <v-data-table
            :options="options"
            :headers="headers"
            :items="adjuntos"
        >
            <template v-slot:item.actions="{ item }">
                <v-icon
                    small
                    @click="editItem(item.id)"
                >
                    mdi-pencil
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
            itemsPerPage: 10,
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

            return moment(f).format('DD/MM/YYYY H:MM:DD');

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
