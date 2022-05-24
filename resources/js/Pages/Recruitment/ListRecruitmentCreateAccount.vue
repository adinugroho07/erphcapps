<template>
  <app-layout title="Dashboard" pathImage="../../image/logo.png">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Applicant List

      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">

          <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
              <thead class="bg-gray-50">
              <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name & Email</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Applicant Code</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIK</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Degree</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Gender</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">View Activity</th>
              </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200">
              <tr v-for="(applicant,index) in applicantlist.data" :key="applicant.id">
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="flex items-center">
                    <div class="ml-4">
                      <div class="text-sm font-medium text-gray-900">
                        {{ applicant.name }}
                      </div>
                      <div class="text-sm text-gray-500">
                        {{ applicant.email }}
                      </div>
                    </div>
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span class="px-2 inline-flex text-xs leading-5 font-semibold text-green-800"> {{ applicant.applicantcode }} </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span class="px-2 inline-flex text-xs leading-5 font-semibold text-green-800"> {{ applicant.NIK }} </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span class="px-2 inline-flex text-xs leading-5 font-semibold text-green-800"> {{ applicant.degree }} </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span class="px-2 inline-flex text-xs leading-5 font-semibold text-green-800"> {{ applicant.gender }} </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span class="px-2 inline-flex text-xs leading-5 font-semibold text-green-800"> {{ applicant.status }} </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <jet-button type="button" @click="create(applicant.id,applicant.name)" class="mr-1 bg-cyan-500 hover:bg-cyan-600">
                    Create
                  </jet-button>
                </td>
              </tr>
              </tbody>
            </table>
          </div>
          <div>
            <pagination class="mt-6" :links="applicantlist.links" />
          </div>
        </div>
      </div>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import {defineComponent} from "vue";
import Pagination from '@/Jetstream/PaginationAction';
import { Link } from "@inertiajs/inertia-vue3";
import JetButton from "@/Jetstream/Button";
import JetLabel from '@/Jetstream/Label.vue';
import JetInput from '@/Jetstream/Input.vue';
import {createToast} from "mosha-vue-toastify";
import 'mosha-vue-toastify/dist/style.css'

export default defineComponent({
  name: "ListRecruitmentCreateAccount",
  components:{
    AppLayout,
    Pagination,
    Link,
    JetButton,
    JetLabel,
    JetInput
  },
  props:['applicantlist'],
  data(){
    return {
      form: this.$inertia.form({
        id: ''
      }),
    }
  },
  methods:{
    notif(title,description,type){
      createToast(
        {
          title: title,
          description: description
        },
        {
          showIcon: 'true',
          hideProgressBar: 'false',
          transition: 'slide',
          type: type,
        }
      )
    },
    create(id,name){
      if (confirm("Do you really want to create user "+name+" ?")){
        this.form.id = id;
        this.form.get('/applicant/user/createuser/',{
            onError: () => {
              this.notif('Error Occured', 'User Already Exists !!', 'danger');
            }
        });
      }
    }

  }
})
</script>

<style scoped>

</style>
