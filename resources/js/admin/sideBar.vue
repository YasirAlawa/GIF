<template>
    <v-navigation-drawer
            id="app-drawer"
            app
            dark
            floating
            persistent
            width="260"
    >
<!--        mobile-break-point="991"-->

        <v-list style="max-height: 64px">
                <v-list-item>
                    <v-list-item-avatar color="white">
                        <v-img
                                src="/image/home/logo_hd.png"
                                height="34"
                                contain
                        />
                    </v-list-item-avatar>
                    <p>SYRIAN RESEARCHERS</p>
                </v-list-item>
            </v-list>
        <v-divider class="mb-3"></v-divider>

        <v-list
                nav
                dense
        >



            <v-list-item
                    :to="user.link"
                    v-if="$auth.check('show-users','permissions')"
                    color="#75ffff"
            >

                <v-list-item-icon>
                    <v-icon>{{user.icon}}</v-icon>
                </v-list-item-icon>

                <v-list-item-content>
                    <v-list-item-title>{{user.text}}</v-list-item-title>
                </v-list-item-content>
            </v-list-item>

            <v-list-group
                    prepend-icon="beenhere"
                    no-action
                    v-if="$auth.check('show-permissions','permissions')"
            >
                <template v-slot:activator>
                    <v-list-item-content>
                        <v-list-item-title>
                            Permissions
                        </v-list-item-title>
                    </v-list-item-content>
                </template>

                <v-list-item
                        v-for="(permission, i) in Permissions"
                        :key="i"
                        sub-group
                        color="#75ffff"
                        :to="permission.link"
                >
                        <v-list-item-icon>
                            <v-icon v-text="permission.icon"></v-icon>
                        </v-list-item-icon>
                        <v-list-item-title v-text="permission.text" class="d-inline-block"></v-list-item-title>


                </v-list-item>
            </v-list-group>

            <v-list-group
                    prepend-icon="menu_book"
                    no-action
                    v-if="$auth.check('show-articles','permissions')"
            >
                <template v-slot:activator>
                    <v-list-item-content>
                        <v-list-item-title>Articles</v-list-item-title>
                    </v-list-item-content>
                </template>

                <v-list-item
                        v-for="(cat, i) in articles"
                        :key="i"
                        sub-group
                        no-action
                        :to="cat.link"
                        color="#75ffff"
                >
                        <v-list-item-icon>
                            <v-icon v-text="cat.icon"></v-icon>
                        </v-list-item-icon>
                        <v-list-item-title v-text="cat.text" class="d-inline-block"></v-list-item-title>


                </v-list-item>
            </v-list-group>


            <v-list-group
                    prepend-icon="category"
                    no-action
                    v-if="$auth.check('show-category','permissions')"
            >
                <template v-slot:activator>
                    <v-list-item-content>
                        <v-list-item-title>Category</v-list-item-title>
                    </v-list-item-content>
                </template>

                <v-list-item
                        v-for="(cat, i) in categories"
                        :key="i"
                        sub-group
                        no-action
                        :to="cat.link"
                        color="#75ffff"
                >
                        <v-list-item-icon>
                            <v-icon v-text="cat.icon"></v-icon>
                        </v-list-item-icon>
                        <v-list-item-title v-text="cat.text" class="d-inline-block"></v-list-item-title>


                </v-list-item>
            </v-list-group>

        </v-list>


    </v-navigation-drawer>
</template>

<script>
    export default {
        props: {
            drawer_prop:'',
        },

        data() {
            return {

                user: {icon: 'group_add', text: 'Users', link: '/Admin/users/index'},
                dashboard: {icon: 'dashboard', text: 'Dashboard', link: '/Admin/'},
                admins: [
                    ['Management', 'mdi-star'],
                    ['Settings', 'mdi-folder'],
                ],
                categories: [
                    {icon: 'scatter_plot', text: 'Show Categories', link: '/Admin/category/show'},
                    {icon: 'mdi-content-duplicate', text: 'Sub Categories', link: '/Admin/category/show-subcategory'}
                ],
                articles: [
                    {icon: 'local_library', text: 'Show Articles', link: '/Admin/article/index'},
                ],
                Permissions: [
                    {icon: 'group_add', text: 'Group', link: '/Admin/users/role/index'},
                    {icon: 'lock', text: 'Permission', link: '/Admin/users/permission/index'},
                ],
                drawer: false,
            }
        }
    }
</script>

<style scoped>
    a {
        text-decoration: none;
        color: #fff;
    }
    .v-navigation-drawer .v-list .v-list-item > .v-list__tile .v-list__tile__title {
        font-size: 14px !important;
        font-weight: 300;
        padding: 0;
    }
    .v-navigation-drawer .v-list .v-list-item .v-list__tile.v-list__tile--active.info {
        background-color: #00bcd4 !important;
    }
    #app-drawer .v-list__tile {
        border-radius: 4px;
    }
    .v-navigation-drawer .v-list .v-list-item > .v-list__tile {
        padding: 10px 15px;
    }
    .v-navigation-drawer .v-list .v-list-item:nth-child(3) {
        margin: 0 15px;
    }
   .v-list-group >>> .v-list-item--active {
        color:#75ffff;
    }
    /*.v-list-item{*/
    /*    margin: 0 15px;*/
    /*}*/
    /*.v-list-group{*/
    /*    margin: 0 15px;*/
    /*v-list-item--active*/
        /*}*/
    .dashboard{

    }

</style>