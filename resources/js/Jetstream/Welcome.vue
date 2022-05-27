<template>
  <div>
    <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
      <div>
        <img
          :src="$page.props.user.profile_photo_url"
          :alt="$page.props.user.name"
          class="block h-40 w-auto rounded-full object-cover"
        />
      </div>

      <div class="mt-8 text-2xl">
        <p class="ml-3 mt-3">
          Welcome {{ $page.props.user.name }} to BHRS application!
        </p>
      </div>

      <div class="mt-6 text-gray-500">
        PT Bahtra Interior merupakan sebuah perusahaan konsultan yang memfokuskan diri sebagai konsultan dan kontraktor interior.
        Didirikan pada tahun 2016, Bahtra Interior memiliki sejarah sepanjang lebih dari 5 tahun dalam bidang perencanaan
        interior dan konstruksi interior untuk hunian, kantor, hotel, dan ruang komersial melalui desain yang disesuaikan dengan
        calon pengguna ruang
      </div>
    </div>

    <div :class="isDoneAbsen">
      <div class="mt-8 font-bold text-2xl mb-4">
        <p v-if="absen">You Have Done Daily Attendance Today</p>
        <p v-else>You Haven't Done Your Daily Attendance Today</p>
      </div>

      <Link v-show="!absen" :href="route('absenrsc.create')">
        <jet-button
          class="mr-1 bg-cyan-500 hover:bg-cyan-600"
          title="Go To Module"
        >
          Go To Attendance Page
        </jet-button>
      </Link>
    </div>

    <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
      <div class="mt-8 text-2xl">
        This Is Assignment That Needs Your Approval.
      </div>

      <div
        class="mt-6 shadow overflow-hidden border-b border-gray-200 sm:rounded-lg"
      >
        <table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gray-50">
            <tr>
              <th
                scope="col"
                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
              >
                No
              </th>
              <th
                scope="col"
                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
              >
                Description
              </th>
              <th
                scope="col"
                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
              >
                Assignment
              </th>
              <th
                scope="col"
                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
              >
                Module
              </th>
              <th
                scope="col"
                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
              >
                Transaction Code
              </th>
              <th
                scope="col"
                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
              >
                Created At
              </th>
              <th scope="col" class="relative px-6 py-3">
                <span class="sr-only">Edit</span>
              </th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            <tr v-for="(assgn, index) in assignment" :key="assgn.id">
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-gray-900">
                  {{ index + 1 }}
                </div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-gray-900">
                  {{ assgn.description }}
                </div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-gray-900">
                  {{ assgn.assignperson }}
                </div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-gray-900">
                  {{ assgn.modulename }}
                </div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-gray-900">
                  {{ assgn.codetransaction }}
                </div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                {{ assgn.created_at }}
              </td>
              <td
                class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium"
              >
                <Link :href="assgn.link">
                  <jet-button
                    class="mr-1 bg-cyan-500 hover:bg-cyan-600"
                    title="Go To Module"
                  >
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      class="h-5 w-5"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke="currentColor"
                      stroke-width="2"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M10 21h7a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v11m0 5l4.879-4.879m0 0a3 3 0 104.243-4.242 3 3 0 00-4.243 4.242z"
                      />
                    </svg>
                  </jet-button>
                </Link>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-1">
      <div class="p-6">

      </div>
    </div>
  </div>
</template>

<script>
import { defineComponent } from "vue";
import JetApplicationLogo from "@/Jetstream/ApplicationLogo.vue";
import { Link } from "@inertiajs/inertia-vue3";
import JetButton from "@/Jetstream/Button";
import JetLabel from "@/Jetstream/Label.vue";
import JetInput from "@/Jetstream/Input.vue";
import Pagination from "@/Jetstream/PaginationAction";
import JetDialogModal from "@/Jetstream/DialogModal";

export default defineComponent({
  props: ["assignment", "absen"],
  components: {
    JetApplicationLogo,
    Link,
    JetButton,
    Pagination,
    JetDialogModal,
    JetLabel,
    JetInput,
  },
  computed:{
    isDoneAbsen(){
      if (this.absen){
        //true
        return 'p-6 sm:px-20 bg-green-400 border-b border-gray-200';
      } else {
        //false
        return 'p-6 sm:px-20 bg-rose-400 border-b border-gray-200';
      }
    }
  },
  mounted() {
  },
});
</script>
