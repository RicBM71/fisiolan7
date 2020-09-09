<template>
    <div>
        <my-dialog :dialog.sync="dialog" registro="registro" @destroyReg="destroyReg"></my-dialog>
        <v-tooltip bottom v-if="isAdmin && foto==false">
            <template v-slot:activator="{ on }">
                <v-btn
                    v-on="on"
                    color="white"
                    icon
                    @click="goCaptura"
                >
                    <v-icon color="red darken-4">add_a_photo</v-icon>
                </v-btn>
            </template>
            <span>Capurar Foto</span>
        </v-tooltip>
        <v-tooltip bottom v-if="isAdmin && foto!=false">
            <template v-slot:activator="{ on }">
                <v-btn
                    v-on="on"
                    color="white"
                    icon
                    @click="goDelCaptura"
                >
                    <v-icon color="red darken-4">remove_circle_outline</v-icon>
                </v-btn>
            </template>
            <span>Eliminar Foto</span>
        </v-tooltip>
        <v-tooltip bottom>
            <template v-slot:activator="{ on }">
                <v-btn
                    v-on="on"
                    color="white"
                    icon
                    @click="goCreate"
                >
                    <v-icon color="primary">add</v-icon>
                </v-btn>
            </template>
                <span>Nuevo</span>
        </v-tooltip>
        <v-tooltip bottom>
            <template v-slot:activator="{ on }">
                <v-btn
                    v-show="id > 0"
                    v-on="on"
                    color="white"
                    icon
                    @click="openDialog"
                >
                    <v-icon color="primary">delete</v-icon>
                </v-btn>
            </template>
                <span>Borrar Registro</span>
        </v-tooltip>
        <v-tooltip bottom>
            <template v-slot:activator="{ on }">
                <v-btn
                    v-on="on"
                    color="white"
                    icon
                    @click="goIndex"
                >
                    <v-icon color="primary">list</v-icon>
                </v-btn>
            </template>
            <span>Lista</span>
        </v-tooltip>
    </div>
</template>
<script>
import {mapGetters} from 'vuex';
import MyDialog from '@/components/shared/MyDialog'
export default {
    props:['id', 'foto'],
    components: {
        'my-dialog': MyDialog
    },
    data () {
      return {
          dialog: false,
          ruta: "paciente",
          url: "/mto/pacientes",
      }
    },
    computed: {
        ...mapGetters([
           'isAdmin'
        ]),
    },
    methods:{
        goCreate(){
            this.$router.push({ name: this.ruta+'.create' })
        },
        goCierre(){
            this.$router.push({ name: this.ruta+'.cierre' })
        },
        goIndex(){
            this.$router.push({ name: this.ruta+'.index' })
        },
        goCaptura(){
            this.$router.push({ name: this.ruta+'.captura' })
        },
        goDelCaptura(){
            axios.post(this.url+'/delcap',{'paciente_id':this.id})
                .then(response => {
                    this.$toast.success('Captura eliminada');
                    this.goCaptura();

            })
            .catch(err => {
                this.status = true;
                var msg = err.response.data.message;
                this.$toast.error(msg);

            });
        },
        openDialog (){
            this.dialog = true;
        },
        destroyReg () {
            this.dialog = false;

            axios.post(this.url+'/'+this.id,{_method: 'delete'})
                .then(response => {

                    this.$router.push({ name: this.ruta+'.index' })
                    this.$toast.success('Registro eliminado!');

            })
            .catch(err => {
                this.status = true;
                var msg = err.response.data.message;
                this.$toast.error(msg);

            });

        },

    }
}
</script>
