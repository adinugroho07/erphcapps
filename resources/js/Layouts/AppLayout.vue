<template>
    <div>
        <Head :title="title" />

        <jet-banner />

        <div class="min-h-screen bg-gray-100">
            <nav class="bg-white border-b border-gray-100">
                <!-- Primary Navigation Menu -->
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <!-- Logo -->
                            <div class="shrink-0 flex items-center">
                                <Link :href="route('dashboard')">
                                  <img :src="pathImage" class="block h-12 w-auto" alt="image"/>
                                </Link>
                            </div>

                            <!-- Navigation Links Security -->
                            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                                <jet-nav-link :href="route('dashboard')" :active="route().current('dashboard')">
                                    Dashboard
                                </jet-nav-link>
                                <!-- start security dropdown -->
                                <jet-dropdown :class="getSecurityIsActive">
                                  <template #trigger>
                                    <button class="pt-0 pb-5">
                                      Security
                                    </button>
                                  </template>

                                  <template #content>
                                    <!-- Account Management -->
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                      Manage Security Apps
                                    </div>

                                    <div class="border-t border-gray-100"></div>
                                    <jet-dropdown-link :href="route('users.index')" :active="route().current('users.*')">
                                      User Account
                                    </jet-dropdown-link>

                                    <div class="border-t border-gray-100"></div>
                                    <jet-dropdown-link :href="route('roleheader.index')"  :active="route().current('role.*')">
                                      Role
                                    </jet-dropdown-link>

                                    <div class="border-t border-gray-100"></div>
                                    <jet-dropdown-link :href="route('assignment.index')"  :active="route().current('assignment.*')">
                                      Assignment
                                    </jet-dropdown-link>

                                    <div class="border-t border-gray-100"></div>
                                    <jet-dropdown-link :href="route('wfassignment.index')"  :active="route().current('wfassignment.*')">
                                      Active Assignment
                                    </jet-dropdown-link>

                                    <div class="border-t border-gray-100"></div>
                                    <jet-dropdown-link :href="route('applicant.listcreateuser')"  :active="route().current('applicant.*')">
                                      List User Recruitment To Be Created
                                    </jet-dropdown-link>



                                  </template>
                                </jet-dropdown>
                                <!-- end security dropdown -->

                                <!-- start Pegawai dropdown -->
                                <jet-dropdown :class="getDataPegawaiIsActive">
                                  <template #trigger>
                                    <button class="pt-0 pb-5">
                                      Employee
                                    </button>
                                  </template>

                                  <template #content>
                                    <!-- Account Management -->
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                      Manage All Employee Data
                                    </div>

                                    <div class="border-t border-gray-100"></div>
                                    <jet-dropdown-link :href="route('pegawai.index')" :active="route().current('pegawai.*')">
                                      Manage Employee
                                    </jet-dropdown-link>

                                    <div class="border-t border-gray-100"></div>
                                    <jet-dropdown-link :href="route('cuti.index')"  :active="route().current('cuti.*')">
                                      Paid Leave
                                    </jet-dropdown-link>

                                    <div class="border-t border-gray-100"></div>
                                    <jet-dropdown-link :href="route('doa.index')"  :active="route().current('doa.*')">
                                      Delegation Of Authority
                                    </jet-dropdown-link>

                                    <div class="border-t border-gray-100"></div>
                                    <jet-dropdown-link :href="route('resign.index')"  :active="route().current('resign.*')">
                                      Resign
                                    </jet-dropdown-link>

                                    <div class="border-t border-gray-100"></div>
                                    <jet-dropdown-link :href="route('mutasi.index')"  :active="route().current('mutasi.*')">
                                      Transfer Position
                                    </jet-dropdown-link>



                                  </template>
                                </jet-dropdown>
                                <!-- end Pegawai dropdown -->

                                <!-- start Timesheet dropdown -->
                                <jet-dropdown :class="getDataTimesheetIsActive">
                                  <template #trigger>
                                    <button class="pt-0 pb-5">
                                      Personal TimeSheet
                                    </button>
                                  </template>

                                  <template #content>
                                    <!-- Account Management -->
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                      Manage All Employee TimeSheet Data
                                    </div>

                                    <div class="border-t border-gray-100"></div>
                                    <jet-dropdown-link :href="route('timesheet.create')" :active="route().current('timesheet.*')">
                                      Create TimeSheet
                                    </jet-dropdown-link>

                                    <div class="border-t border-gray-100"></div>
                                    <jet-dropdown-link :href="route('timesheet.index')" :active="route().current('timesheet.*')">
                                      List Personal Timesheet
                                    </jet-dropdown-link>

                                    <div class="border-t border-gray-100"></div>
                                    <jet-dropdown-link :href="route('timesheet.all')"  :active="route().current('timesheet.*')">
                                      All TimeSheet
                                    </jet-dropdown-link>

                                  </template>
                                </jet-dropdown>
                                <!-- end Timesheet dropdown -->

                                <!-- start Attendance dropdown -->
                                <jet-dropdown :class="getDataAttendanceIsActive">
                                  <template #trigger>
                                    <button class="pt-0 pb-5">
                                      Attendance
                                    </button>
                                  </template>

                                  <template #content>
                                    <!-- Account Management -->
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                      Manage All Employee Attendance Data
                                    </div>

                                    <div class="border-t border-gray-100"></div>
                                    <jet-dropdown-link :href="route('absenrsc.create')" :active="route().current('absenrsc.*')">
                                      Create Attendance
                                    </jet-dropdown-link>

                                    <div class="border-t border-gray-100"></div>
                                    <jet-dropdown-link :href="route('absenrsc.index')" :active="route().current('absenrsc.*')">
                                      List Personal Attendance
                                    </jet-dropdown-link>

                                    <div class="border-t border-gray-100"></div>
                                    <jet-dropdown-link :href="route('absenrsc.all')"  :active="route().current('absenrsc.all')">
                                      All Attendance
                                    </jet-dropdown-link>

                                  </template>
                                </jet-dropdown>
                                <!-- end Attendance dropdown -->

                                <jet-nav-link :href="route('applicant.index')" :active="route().current('applicant.*')">
                                  Recruitment
                                </jet-nav-link>
                            </div>


                        </div>

                        <div class="hidden sm:flex sm:items-center sm:ml-6">
                            <div class="ml-3 relative">
                                <!-- Teams Dropdown -->
                                <jet-dropdown align="right" width="60" v-if="$page.props.jetstream.hasTeamFeatures">
                                    <template #trigger>
                                        <span class="inline-flex rounded-md">
                                            <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:bg-gray-50 hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition">
                                                {{ $page.props.user.current_team.name }}

                                                <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </span>
                                    </template>

                                    <template #content>
                                        <div class="w-60">
                                            <!-- Team Management -->
                                            <template v-if="$page.props.jetstream.hasTeamFeatures">
                                                <div class="block px-4 py-2 text-xs text-gray-400">
                                                    Manage Team
                                                </div>

                                                <!-- Team Settings -->
                                                <jet-dropdown-link :href="route('teams.show', $page.props.user.current_team)">
                                                    Team Settings
                                                </jet-dropdown-link>

                                                <jet-dropdown-link :href="route('teams.create')" v-if="$page.props.jetstream.canCreateTeams">
                                                    Create New Team
                                                </jet-dropdown-link>

                                                <div class="border-t border-gray-100"></div>

                                                <!-- Team Switcher -->
                                                <div class="block px-4 py-2 text-xs text-gray-400">
                                                    Switch Teams
                                                </div>

                                                <template v-for="team in $page.props.user.all_teams" :key="team.id">
                                                    <form @submit.prevent="switchToTeam(team)">
                                                        <jet-dropdown-link as="button">
                                                            <div class="flex items-center">
                                                                <svg v-if="team.id == $page.props.user.current_team_id" class="mr-2 h-5 w-5 text-green-400" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                                <div>{{ team.name }}</div>
                                                            </div>
                                                        </jet-dropdown-link>
                                                    </form>
                                                </template>
                                            </template>
                                        </div>
                                    </template>
                                </jet-dropdown>
                            </div>

                            <!-- Settings Dropdown -->
                            <div class="ml-3 relative">
                                <jet-dropdown align="right" width="48">
                                    <template #trigger>
                                        <button v-if="$page.props.jetstream.managesProfilePhotos" class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                            <img class="h-8 w-8 rounded-full object-cover" :src="$page.props.user.profile_photo_url" :alt="$page.props.user.name" />
                                        </button>

                                        <span v-else class="inline-flex rounded-md">
                                            <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition">
                                                {{ $page.props.user.name }}

                                                <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </span>
                                    </template>

                                    <template #content>
                                        <!-- Account Management -->
                                        <div class="block px-4 py-2 text-xs text-gray-400">
                                            Manage Account
                                        </div>

                                        <jet-dropdown-link :href="route('profile.show')">
                                            Profile
                                        </jet-dropdown-link>

                                        <jet-dropdown-link :href="route('api-tokens.index')" v-if="$page.props.jetstream.hasApiFeatures">
                                            API Tokens
                                        </jet-dropdown-link>

                                        <div class="border-t border-gray-100"></div>

                                        <!-- Authentication -->
                                        <form @submit.prevent="logout">
                                            <jet-dropdown-link as="button">
                                                Log Out
                                            </jet-dropdown-link>
                                        </form>
                                    </template>
                                </jet-dropdown>
                            </div>
                        </div>

                        <!-- Hamburger -->
                        <div class="-mr-2 flex items-center sm:hidden">
                            <button @click="showingNavigationDropdown = ! showingNavigationDropdown" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition">
                                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path :class="{'hidden': showingNavigationDropdown, 'inline-flex': ! showingNavigationDropdown }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                    <path :class="{'hidden': ! showingNavigationDropdown, 'inline-flex': showingNavigationDropdown }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Responsive Navigation Menu -->
                <div :class="{'block': showingNavigationDropdown, 'hidden': ! showingNavigationDropdown}" class="sm:hidden">
                    <div class="pt-2 pb-3 space-y-1">
                        <jet-responsive-nav-link :href="route('dashboard')" :active="route().current('dashboard')">
                            Dashboard
                        </jet-responsive-nav-link>
                    </div>

                    <!-- Responsive Settings Options -->
                    <div class="pt-4 pb-1 border-t border-gray-200">
                        <div class="flex items-center px-4">
                            <div v-if="$page.props.jetstream.managesProfilePhotos" class="shrink-0 mr-3" >
                                <img class="h-10 w-10 rounded-full object-cover" :src="$page.props.user.profile_photo_url" :alt="$page.props.user.name" />
                            </div>

                            <div>
                                <div class="font-medium text-base text-gray-800">{{ $page.props.user.name }}</div>
                                <div class="font-medium text-sm text-gray-500">{{ $page.props.user.email }}</div>
                            </div>
                        </div>

                        <div class="mt-3 space-y-1">
                            <jet-responsive-nav-link :href="route('profile.show')" :active="route().current('profile.show')">
                                Profile
                            </jet-responsive-nav-link>

                            <jet-responsive-nav-link :href="route('api-tokens.index')" :active="route().current('api-tokens.index')" v-if="$page.props.jetstream.hasApiFeatures">
                                API Tokens
                            </jet-responsive-nav-link>

                            <!-- Authentication -->
                            <form method="POST" @submit.prevent="logout">
                                <jet-responsive-nav-link as="button">
                                    Log Out
                                </jet-responsive-nav-link>
                            </form>

                            <!-- Team Management -->
                            <template v-if="$page.props.jetstream.hasTeamFeatures">
                                <div class="border-t border-gray-200"></div>

                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    Manage Team
                                </div>

                                <!-- Team Settings -->
                                <jet-responsive-nav-link :href="route('teams.show', $page.props.user.current_team)" :active="route().current('teams.show')">
                                    Team Settings
                                </jet-responsive-nav-link>

                                <jet-responsive-nav-link :href="route('teams.create')" :active="route().current('teams.create')" v-if="$page.props.jetstream.canCreateTeams">
                                    Create New Team
                                </jet-responsive-nav-link>

                                <div class="border-t border-gray-200"></div>

                                <!-- Team Switcher -->
                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    Switch Teams
                                </div>

                                <template v-for="team in $page.props.user.all_teams" :key="team.id">
                                    <form @submit.prevent="switchToTeam(team)">
                                        <jet-responsive-nav-link as="button">
                                            <div class="flex items-center">
                                                <svg v-if="team.id == $page.props.user.current_team_id" class="mr-2 h-5 w-5 text-green-400" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                <div>{{ team.name }}</div>
                                            </div>
                                        </jet-responsive-nav-link>
                                    </form>
                                </template>
                            </template>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Heading -->
            <header class="bg-white shadow" v-if="$slots.header">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <slot name="header"></slot>
                </div>
            </header>

            <!-- Page Content -->
            <main>
                <slot></slot>
            </main>
        </div>
    </div>
</template>

<script>
    import { defineComponent } from 'vue'
    import JetApplicationMark from '@/Jetstream/ApplicationMark.vue'
    import JetBanner from '@/Jetstream/Banner.vue'
    import JetDropdown from '@/Jetstream/Dropdown.vue'
    import JetDropdownLink from '@/Jetstream/DropdownLink.vue'
    import JetNavLink from '@/Jetstream/NavLink.vue'
    import JetResponsiveNavLink from '@/Jetstream/ResponsiveNavLink.vue'
    import { Head, Link } from '@inertiajs/inertia-vue3';

    export default defineComponent({
        props: {
            title: String,
            pathImage:{
              type: String,
              required: false,
              default: 'image/logo.png'
            }
        },

        components: {
            Head,
            JetApplicationMark,
            JetBanner,
            JetDropdown,
            JetDropdownLink,
            JetNavLink,
            JetResponsiveNavLink,
            Link,
        },

        data() {
            return {
                showingNavigationDropdown: false,
            }
        },
        computed:{
            getSecurityIsActive(){
              //console.log(this.$page.props);
              let classActive = '';
              const users = this.route().current('users.*');
              const role = this.route().current('role.*');
              if(users || role){
                classActive = 'mt-5 pt-1 border-b-2 border-indigo-400 text-sm font-medium leading-5 text-gray-900 focus:outline-none focus:border-indigo-700 transition';
              } else {
                classActive = 'mt-5 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition';
              }
              return classActive;
            },
            getDataPegawaiIsActive(){
              let classActive = '';
              const role = this.route().current('pegawai.*');
              const cuti = this.route().current('cuti.*');
              const searchcuti = this.route().current('searchcuti');
              const assigncuti = this.route().current('assigncuti.show');
              const doa = this.route().current('doa.*');
              const searchdoa = this.route().current('searchdoa');
              const assigndoa = this.route().current('assigndoa.show');
              const resign = this.route().current('resign.*');
              const assignresign = this.route().current('assignresign.show');
              const mutasi = this.route().current('mutasi.*');
              const searchmutasi = this.route().current('searchmutasi');
              const assignmutasi = this.route().current('assignmutasi.show');
              if(role || cuti || doa || resign || mutasi || searchcuti || searchdoa || searchmutasi || assigncuti || assigndoa || assignmutasi || assignresign){
                classActive = 'mt-5 pt-1 border-b-2 border-indigo-400 text-sm font-medium leading-5 text-gray-900 focus:outline-none focus:border-indigo-700 transition';
              } else {
                classActive = 'mt-5 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition';
              }
              return classActive;
            },
            getDataTimesheetIsActive(){
              let classActive = '';
              const timesheet = this.route().current('timesheet.*');
              const searchtimesheet = this.route().current('searchtimesheet');
              const searchtimesheetwithactivelogin = this.route().current('searchtimesheetwithactivelogin');
              const assigntimesheet = this.route().current('assigntimesheet.show');
              if(timesheet || searchtimesheet || assigntimesheet || searchtimesheetwithactivelogin){
                classActive = 'mt-5 pt-1 border-b-2 border-indigo-400 text-sm font-medium leading-5 text-gray-900 focus:outline-none focus:border-indigo-700 transition';
              } else {
                classActive = 'mt-5 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition';
              }
              return classActive;
            },
            getDataAttendanceIsActive(){
              let classActive = '';
              const timesheet = this.route().current('absenrsc.*');
              const searchabsenwithactivelogin = this.route().current('searchabsenwithactivelogin');
              const searchabsen = this.route().current('searchabsen');
              if(timesheet || searchabsenwithactivelogin || searchabsen){
                classActive = 'mt-5 pt-1 border-b-2 border-indigo-400 text-sm font-medium leading-5 text-gray-900 focus:outline-none focus:border-indigo-700 transition';
              } else {
                classActive = 'mt-5 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition';
              }
              return classActive;
            }
        },
        methods: {
            switchToTeam(team) {
                this.$inertia.put(route('current-team.update'), {
                    'team_id': team.id
                }, {
                    preserveState: false
                })
            },

            logout() {
                this.$inertia.post(route('logout'));
            },
        }
    })
</script>
