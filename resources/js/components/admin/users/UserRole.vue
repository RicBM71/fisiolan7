<template>
    <v-container>
        <v-row no-gutters>
            <h3>Roles</h3>
        </v-row>
        <v-row no-gutters>
            <v-col cols="12"
                md="3"
                v-for="item in roles"
                :key="item"
            >
                <v-switch
                    v-on:change="setUserRole"
                    v-model="role_selected"
                    :label="item"
                    :value="item"
                    color="success">
                ></v-switch>
            </v-col>
        </v-row>
    </v-container>
</template>
<script>
export default {
    props: ['user_id','role_user'],
    data () {
        return {
            roles: [],
            role_selected: [],
            show: false
        }
    },
    beforeMount(){

            //cargamos todos los roles disponibles
        axios.get('/admin/roles')
            .then(res => {

                var roles = [];

                res.data.roles.forEach(function(element) {
                    roles.push(element.name);
                });

                this.roles = roles;

                this.show = (roles.length > 0 );
            })
            .catch(err => {
                this.$toast.error(err.response.data.message);
                this.$router.push({ name: 'users'})
            })

        // cargamos los roles que tiene ya tiene el usuario
        this.role_selected = this.role_user;

    },
    methods:{
                //actualizamos role x usuario
        setUserRole(){

            axios({
                method: 'put',
                url: '/admin/users/'+this.user_id+'/roles',
                data:
                    {
                        roles: this.role_selected
                    }
                })
                .then(res => {

                    this.$toast.success(res.data);
                })
                .catch(err => {

                    const msg_valid = err.response.data.errors;
                    for (const prop in msg_valid) {
                        this.$toast.error(`${msg_valid[prop]}`);
                    }
                });
        }
    }
}
</script>

