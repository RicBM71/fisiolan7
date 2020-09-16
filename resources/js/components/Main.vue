<template>
    <v-container grid-list-md text-xs-center>
        <v-layout row wrap>
            <v-flex sm3 xs12>
                 <v-btn rounded block large color="grey" class="blue-grey lighten-3" @click="goPacientes()">
                     Pacientes
                     <v-icon right dark>account_multiple</v-icon>
                </v-btn>
            </v-flex>
            <v-flex sm3 xs12>
                 <v-btn rounded block large color="grey" class="blue-grey lighten-3" @click="goUsers()">
                     Usuarios
                     <v-icon right dark>account_multiple</v-icon>
                </v-btn>
            </v-flex>
        </v-layout>
        <v-layout row wrap v-if="logo!=null">
            <v-flex xs2></v-flex>
            <v-flex xs8>
                <v-responsive>
                    <v-layout column>
                        <v-img class="img-fluid" :src="logo"></v-img>
                    </v-layout>
                </v-responsive>
            </v-flex>
        </v-layout>
    </v-container>
</template>
<script>
import {mapActions} from "vuex";
import {mapGetters} from 'vuex';
export default {
    computed:{
        ...mapGetters([
            'isLoggedIn',
            'isRoot',
            'isAdmin',
            'empresaActiva',
            'imgFondo'
		]),
    },
    data: () => ({
        logo: ""
    }),
    mounted(){

        axios.get('/dash')
            .then(res => {

                this.setAuthUser(res.data.user);

                //this.logo = "/storage/logos/"+this.empresaActiva+".png";
                this.logo = this.imgFondo;
            })
            .catch(err => {
                console.log(err);
        })

    },
    watch: {
        empresaActiva: function (newValue) {

            //this.logo = "/storage/logos/"+newValue+".png";
            this.logo = this.imgFondo;
        }
    },
    methods:{
        ...mapActions([
				'setAuthUser'
            ]),
        goPacientes(){
            this.$router.push({ name: 'paciente.index' })
        },
    },

  }
</script>
