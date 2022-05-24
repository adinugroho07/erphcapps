<template>
  <app-layout title="Dashboard">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Assignment List

      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
          <div class="float-right">
            <Link href="assignment/create">
              <jet-button class="bg-emerald-500">Create Assignment</jet-button>
            </Link>
          </div>
          <div class="flex">
            <div class="mb-3 xl:w-96">
              <form @submit.prevent="searching">
                <div class="input-group relative flex flex-wrap items-stretch w-full mb-4">
                  <input type="search" v-model="searchValue.search" class="form-control relative flex-auto min-w-0 block w-6 px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" placeholder="Search" aria-label="Search" aria-describedby="button-addon2">
                  <button class="btn inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700  focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out flex items-center" type="submit" id="button-addon2">
                    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="search" class="w-4" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                      <path fill="currentColor" d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z"></path>
                    </svg>
                  </button>
                </div>
              </form>
            </div>
          </div>
          <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
              <thead class="bg-gray-50">
              <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Assignment Code</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Assignment Name & Description</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Active</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created & Updated At</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
              </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200">
              <tr v-for="(assignment,index) in assignmentlist.data" :key="assignment.id">
                <td class="px-6 py-4 whitespace-nowrap">
                  <span class="px-2 inline-flex text-xs leading-5 font-semibold text-green-800"> {{ assignment.assignment_code }} </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="text-sm text-gray-900">
                    {{ assignment.assignment_name }}
                  </div>
                  <div class="text-sm text-gray-500">
                    {{ assignment.assignment_description }}
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span class="px-2 inline-flex text-xs leading-5 font-semibold text-green-800"> {{ assignment.isactive===0 ? 'Non Active':'Active' }} </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="text-sm text-gray-900">
                    {{ assignment.created_at }}
                  </div>
                  <div class="text-sm text-gray-500">
                    {{ assignment.updated_at }}
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <Link :href="route('assignment.show',assignment.id)">
                    <jet-button class="mr-1 bg-cyan-500 hover:bg-cyan-600">
                      Show
                    </jet-button>
                  </Link>
                  <Link :href="route('assignment.edit',assignment.id)">
                    <jet-button class="mr-1 bg-cyan-500 hover:bg-cyan-600">
                      Edit
                    </jet-button>
                  </Link>
                </td>
              </tr>
              </tbody>
            </table>
          </div>
          <div>
            <pagination class="mt-6" :links="assignmentlist.links" />
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
  name: "ListAssignment",
  components:{
    AppLayout,
    Pagination,
    Link,
    JetButton,
    JetLabel,
    JetInput
  },
  props:['assignmentlist'],
  data(){
    return {
      searchValue: this.$inertia.form({
        search: ''
      }),
    }
  },
  methods: {
    searching() {
      this.searchValue.post(route('searchassignment'), {
        preserveScroll: false,
        onSuccess: () => {
          this.searchValue.reset('search')
        }
      });
    }
  }
})
</script>

<style scoped>

</style>
