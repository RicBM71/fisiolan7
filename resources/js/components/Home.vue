<template>
    <v-app id="inspire">
        <loading :show_loading="show_loading"></loading>
          <div class="text-xs-center">
            <v-dialog
            v-model="myEmpresa"
            width="500"
            >
            <v-card>
                <v-card-title
                class="headline grey lighten-2"
                primary-title
                >
                Seleccionar empresa
                </v-card-title>

                <v-card-text>
                    <v-flex sm2 d-flex></v-flex>
                    <v-flex sm8 d-flex>
                        <v-select
                            v-on:change="setEmpresa"
                            v-model="empresa_id"
                            :items="empresas"
                            label="Empresa"
                        ></v-select>
                    </v-flex>
                </v-card-text>

                <v-divider></v-divider>

                <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn
                    color="primary"
                    rounded
                    text
                    @click="myEmpresa=false"
                >
                    Cerrar
                </v-btn>
                </v-card-actions>
            </v-card>
            </v-dialog>
        </div>
        <v-navigation-drawer
        v-model="drawer"
        :clipped="$vuetify.breakpoint.lgAndUp"
        app
        >
        <v-list dense>
            <template v-for="item in items">
            <v-row
                v-if="item.heading"
                :key="item.heading"
                align="center"
            >
                <v-col cols="6">
                <v-subheader v-if="item.heading">
                    {{ item.heading }}
                </v-subheader>
                </v-col>
                <v-col
                cols="6"
                class="text-center"
                >
                <a
                    href="#!"
                    class="body-2 black--text"
                >EDIT</a>
                </v-col>
            </v-row>
            <v-list-group
                v-else-if="item.children"
                :key="item.text"
                v-model="item.model"
                :prepend-icon="item.model ? item.icon : item['icon-alt']"
                append-icon=""
            >
                <template v-slot:activator>
                <v-list-item-content>
                    <v-list-item-title>
                    {{ item.text }}
                    </v-list-item-title>
                </v-list-item-content>
                </template>
                <v-list-item
                v-for="(child, i) in item.children"
                :key="i"
                link
                >
                <v-list-item-action v-if="child.icon">
                    <v-icon>{{ child.icon }}</v-icon>
                </v-list-item-action>
                <v-list-item-content @click="abrir(child.name)">
                    <v-list-item-title>
                    {{ child.text }}
                    </v-list-item-title>
                </v-list-item-content>
                </v-list-item>
            </v-list-group>
            <v-list-item
                v-else
                :key="item.text"
                link
            >
                <v-list-item-action>
                <v-icon>{{ item.icon }}</v-icon>
                </v-list-item-action>
                <v-list-item-content>
                <v-list-item-title @click="abrir(item.name)">
                    {{ item.text }}
                </v-list-item-title>
                </v-list-item-content>
            </v-list-item>
            </template>
        </v-list>
        </v-navigation-drawer>

        <v-app-bar
        :clipped-left="$vuetify.breakpoint.lgAndUp"
        app
        color="blue darken-3"
        dark
        >
        <v-app-bar-nav-icon @click.stop="drawer = !drawer" />
        <v-toolbar-title
            style="width: 300px"
            class="ml-0 pl-4"
        >
            <span class="hidden-sm-and-down">{{ this.user.empresa_nombre }}</span>
        </v-toolbar-title>
        <v-spacer />
        <v-tooltip bottom>
            <template v-slot:activator="{ on }">
                <v-btn v-on="on" icon v-show="jobs > 0">
                    <v-icon color="red darken-4">mdi-bell</v-icon>
                </v-btn>
            </template>
            <span>({{jobs}}) Mails pendientes de envio.</span>
        </v-tooltip>

        <!-- <v-btn icon v-on:click="empresa">
            <v-icon>mdi-briefcase</v-icon>
        </v-btn> -->
        <v-btn icon v-on:click="home">
            <v-icon>mdi-home</v-icon>
        </v-btn>
        <v-btn icon v-on:click="passwd">
            <v-avatar v-if="user.avatar !='#'" size="32px">
                <img class="img-fluid" :src="user.avatar">
            </v-avatar>
            <v-icon v-else>mdi-settings</v-icon>
        </v-btn>
        <strong v-html="user.name"></strong>
        <v-btn icon v-on:click="Logout">
            <v-avatar size="32px" tile>
                <v-icon>mdi-exit-to-app</v-icon>
            </v-avatar>
        </v-btn>

        </v-app-bar>
        <v-main>
        <v-container
            fluid
        >
        <!--     <v-row
            align="center"
            justify="center"
            > -->
              <router-view :key="$route.fullPath"></router-view>

            <!-- </v-row> -->
        </v-container>
        </v-main>
    </v-app>
</template>
<script>
import {mapActions} from "vuex";
import {mapState} from 'vuex'
import {mapGetters} from 'vuex';
import Loading from '@/components/shared/Loading'
export default {
    components: {
        'loading': Loading,
    },
    computed:{
        ...mapState({
            user: state => state.auth
        }),
        ...mapGetters([
            'isLoggedIn',
            'isRoot',
            'isAdmin',
		]),
    },
    data: () => ({
        menu: true,
        dialog: false,
        drawer: true,
        show: true,

        empresaTxt:"...",
        empresas:[],
        myEmpresa:false,
        empresa_id:0,
        jobs: 0,
        show_loading:  false,

        items: [
            { icon: 'mdi-contacts', text: 'Pacientes', name: 'pacientes.index' },
            { icon: 'mdi-history', text: 'Frequently contacted' },
            { icon: 'mdi-content-copy', text: 'Duplicates' },
            {
            icon: 'mdi-chevron-up',
            'icon-alt': 'mdi-chevron-down',
            text: 'Mantenimmientos',
            model: true,
            children: [
                { icon: 'mdi-plus', text: 'Bonos', name:'bono.index' },
                { icon: 'mdi-plus', text: 'Tratamientos', name:'bono.index'  },
            ],
            },
            {
            icon: 'mdi-chevron-up',
            'icon-alt': 'mdi-chevron-down',
            text: 'Administración',
            model: false,
            children: [
                { text: 'Empresas', name: 'empresa.index' },
                { text: 'Usuarios' },
                { text: 'Print' },
                { text: 'Undo changes' },
                { text: 'Other contacts' },
            ],
            },
            { icon: 'mdi-settings', text: 'Settings' },
        ],

        expired: false,
    }),
    mounted(){

        axios.get('/dash')
                .then(res => {

                    this.setAuthUser(res.data.user);

                   // this.mn_items.push(this.mn_etiquetas);



                    this.empresa_id = this.user.empresa_id;


                    this.empresas = res.data.user.empresas;
                    var idx = this.empresas.map(x => x.value).indexOf(this.empresa_id);

                    // this.empresaTxt = this.empresas[idx].text;
                    //this.empresaTxt = this.user.empresa_nombre;

                    this.jobs = res.data.jobs;

                    //this.productos_online = res.data.productos_online;

                    // res.data.user.empresas.map((e) =>{
                    //     if (e.id == this.empresa_id)
                    //         this.empresaTxt = e.titulo;
                    //     this.empresas.push({id: e.id, name: e.titulo});
                    // })

                    this.empresas.sort(function (a, b) {
                    if (a.text > b.text) {
                        return 1;
                    }
                    if (a.text < b.text) {
                        return -1;
                    }
                    // a must be equal to b
                    return 0;
                    });

                    this.expired = res.data.expired;

                    if (this.expired){
                        this.$toast.error('Password ha Expirado, debe reemplazarla');
                        this.$router.push({name: 'edit.password'});
                    }

                })
                .catch(err => {

                    this.show = false;
                    if (err.request.status == 401){ // fallo de validated.
                        //this.$router.push("/login");
                        window.location = '/login';
                    }
                })

    },

    methods:{
        ...mapActions([
                'setAuthUser',
                'unsetParametros'
			]),
        abrir(name){
            console.log(name);
            //this.drawer = false;
            this.$router.push({name: name});
        },
        home(){
            axios.get('/dash')
                .then(res => {

                    this.setAuthUser(res.data.user);

                    this.empresa_id = this.user.empresa_id;
                    this.empresas = res.data.user.empresas;
                    this.empresas.sort(function (a, b) {
                    if (a.text > b.text) {
                        return 1;
                    }
                    if (a.text < b.text) {
                        return -1;
                    }
                    // a must be equal to b
                    return 0;
                    });
                    //this.empresas = res.data.user.empresas.sortBy('text');
                    var idx = this.empresas.map(x => x.value).indexOf(this.empresa_id);

                    this.empresaTxt = this.empresas[idx].text;

                    this.jobs = res.data.jobs;

                    // res.data.user.empresas.map((e) =>{
                    //     if (e.value == this.empresa_id)
                    //         this.empresaTxt = e.text;
                    //     this.empresas.push({id: e.id, name: e.titulo});
                    // })

                    this.expired = res.data.expired;
                    if (this.expired){
                        this.$toast.error('Password ha Expirado, debe reemplazarla');
                        this.$router.push({name: 'edit.password'});
                    }

                })
                .catch(err => {
                    this.show = false;
                    if (err.request.status == 401){ // fallo de validated.
                        window.location = '/login';
                    }
                })

            this.$router.push({name: 'dash'});
        },
        passwd(){
            this.$router.push({name: 'edit.password'});
        },
        empresa(){
            this.empresa_id = this.empresaActiva;
            this.myEmpresa=true;
        },
        getReloadEmpresa(){
            this.show_loading = true;
            axios.get('/dash')
                .then(res => {

                    this.setAuthUser(res.data.user);
                    var idx = this.empresas.map(x => x.value).indexOf(this.empresa_id);
                    this.empresaTxt = this.empresas[idx].text;
                    if (this.$route.path != '/home')
                        this.$router.push({name: 'dash'});
                })
                .catch(err => {
                    this.$toast.error("Fallo en reload empresa...");
                })
                 .finally(()=> {
                        this.show_loading = false;
                });
        },
        setEmpresa(){

            this.show_loading = true;
            this.empresas.map((e) =>{
                   if (e.id == this.empresa_id)
                        this.empresaTxt = e.name;
                });

            axios({
                    method: 'put',
                    url: '/admin/users/'+this.user.id+'/empresa',
                    data:{ empresa_id: this.empresa_id }
                })
                .then(res => {
                    //this.$toast.success("Cambiando de empresa...");
                   // this.setAuthUser(res.data.user);

                    this.getReloadEmpresa();
                   // this.$router.push({name: 'dash'});
                })
                .catch(err => {
                    this.$toast.error("No se ha podido seleccionar la empresa");
                });

            this.myEmpresa=false;
        },
        Logout() {
            this.$toast.success('Logout, espere...');
            axios.post('/logout').then(res => {

                this.$store.dispatch('unsetAuthUser')
                this.$router.push({name: 'index'});
			})
        },
    }
  }
</script>
