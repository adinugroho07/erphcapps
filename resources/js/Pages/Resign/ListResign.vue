<template>
  <app-layout title="Dashboard">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Paid Leave List Page

      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
          <div class="mb-5">
            <Link href="resign/create">
              <jet-button class="bg-emerald-500">Create Resign Form</jet-button>
            </Link>
          </div>
          <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
              <thead class="bg-gray-50">
              <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Code</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name By & Email</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Start & End Work</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
              </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200">
              <tr v-for="(objresign,index) in resign.data" :key="objresign.id">
                <td class="px-6 py-4 whitespace-nowrap">
                  <span class="px-2 inline-flex text-xs leading-5 font-semibold text-green-800"> {{ objresign.resigncode }} </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="text-sm text-gray-900">
                    {{ objresign.name }}
                  </div>
                  <div class="text-sm text-gray-500">
                    {{ objresign.email }}
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="text-sm text-gray-900">
                    {{ objresign.startwork }}
                  </div>
                  <div class="text-sm text-gray-500">
                    {{ objresign.endwork }}
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span class="px-2 inline-flex text-xs leading-5 text-green-800"> {{ objresign.status }} </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <Link :href="'resign/' + objresign.id">
                    <jet-button class="mr-1 bg-cyan-500 hover:bg-cyan-600">
                      Show
                    </jet-button>
                  </Link>
                  <Link v-show="objresign.status !== 'COMPLETE' || objresign.status !== 'DRAFT' || objresign.status !== 'HOLD'" :href="'/assignment/' + objresign.id + '/resign/approval/'">
                    <jet-button class="mr-1 bg-cyan-500 hover:bg-cyan-600">
                      Route
                    </jet-button>
                  </Link>
                </td>
              </tr>
              </tbody>
            </table>
          </div>
          <div>
            <pagination class="mt-6" :links="resign.links" />
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

export default defineComponent({
  name: "ListResign",
  components:{
    AppLayout,
    Pagination,
    Link,
    JetButton,
    JetLabel,
    JetInput
  },
  props:['resign'],
  data(){
    return {
      searchValue: this.$inertia.form({
        search: ''
      }),
    }
  },
  methods: {
    searching() {
      this.searchValue.post('/applicant/search', {
        preserveScroll: false,
        onSuccess: () => {
          this.form.reset('search')
        }
      });
    }
  }
})
</script>

<style scoped>

</style>
