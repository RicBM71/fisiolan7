
<template>
<div>
        <loading :show_loading="loading"></loading>
		<my-dialog :dialog.sync="dialog" registro="registro" @destroyReg="destroyReg"></my-dialog>
        <v-card>
            <v-card-title>
                <h2>{{titulo}}</h2>
                <v-spacer></v-spacer>
                <menu-ope></menu-ope>
            </v-card-title>
        </v-card>
        <v-card v-if="!loading">
            <v-card-title>
                <v-spacer></v-spacer>
                <v-text-field
                    v-model="search"
                    append-icon="mdi-magnify"
                    label="Buscar"
                    single-line
                    hide-details
                ></v-text-field>
            </v-card-title>

            <v-data-table
                :search="search"
                :headers="headers"
                :items="items"
            >
            <template v-slot:item.actions="{ item }">
                <v-icon
                    small
                    class="mr-2"
                    @click="editItem(item.id)"
                >
                    mdi-pencil
                </v-icon>
                <v-icon
                    small
                    @click="openDialog(item.id)"
                >
                    mdi-delete
                </v-icon>
            </template>
            </v-data-table>
        </v-card>
    </div>
</template>
<script>
import MyDialog from '@/components/shared/MyDialog'
import Loading from '@/components/shared/Loading'
import MenuOpe from './MenuOpe'
import {mapGetters} from 'vuex'
import {mapActions} from "vuex";
  export default {
    components: {
        'my-dialog': MyDialog,
        'menu-ope': MenuOpe,
        'loading': Loading
    },
    data () {
      return {
        titulo: "Tipos de bono",
        search:"",
        headers: [
            {
                text: 'Nombre',
                align: 'left',
                value: 'nombre'
            },
            {
                text: 'Sesiones',
                align: 'left',
                value: 'sesiones'
            },
            {
                text: 'Caducidad',
                align: 'left',
                value: 'caducidad'
            },
            {
                text: 'Importe',
                align: 'left',
                value: 'importe'
            },
            {
                text: 'Acciones',
                align: 'Center',
                value: ''
            }
        ],
        items:[],
        status: false,
		registros: false,
        dialog: false,
        item_id: 0,
        loading: true

      }
    },
    mounted()
    {

        axios.get('/mto/bonos')
            .then(res => {

                this.bonos = res.data;
                this.registros = true;

            })
            .catch(err =>{
               ;
                this.$toast.error(err.response.data.message);
                this.$router.push({ name: 'dash' })
            })
            .finally(()=>{
                this.loading = false;
            });
    },
    computed: {
        ...mapGetters([
            'isRoot',
            'getPagination'
        ])
    },
    methods:{
        ...mapActions([
            'setPagination',
            'unsetPagination'
		]),
        updateEventPagina(obj){

            this.paginaActual = obj;

        },
        updatePosPagina(pag){

            this.pagination.page = pag.page;
            this.pagination.descending = pag.descending;
            this.pagination.rowsPerPage= pag.rowsPerPage;
            this.pagination.sortBy = pag.sortBy;

        },
        create(){
            this.$router.push({ name: 'bono.create'})
        },
        editItem (id) {
            this.setPagination(this.paginaActual);
            this.$router.push({ name: 'bono.edit', params: { id: id } })
        },
        openDialog (id){
            this.dialog = true;
            this.item_id = id;
        },
        destroyReg () {
            this.dialog = false;

            axios.post('/mto/bonos/'+this.item_id,{_method: 'delete'})
                .then(response => {

                if (response.status == 200){
                    this.$toast.success('bono eliminado!');
                    this.bonos = response.data;
                }
                })
            .catch(err => {
                this.status = true;

                var msg = err.response.data.message;
                this.$toast.error(msg);

            });

        }
    }
  }
</script>

<style scoped>
  .tachado{text-decoration:line-through;}
</style>
