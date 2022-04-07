<template>
  <app-layout title="Dashboard">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Absen Page
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
          <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
            <div id="app">
              <div id="myDiagramDiv"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import JetFormSection from '@/Jetstream/FormSection.vue';
import {defineComponent} from "vue";
import OrganizationChart from 'vue-organization-chart'
import 'vue-organization-chart/dist/orgchart.css'
import go from 'gojs'

export default defineComponent({
  components:{
    AppLayout,
    JetFormSection,
    OrganizationChart
  },
  data(){
    return {
      myDiagram: ''
    }
  },
  methods:{
    chart1(){
      const $ = go.GraphObject.make;  // for conciseness in defining templates
      const myDiagram =
        $(go.Diagram, "myDiagramDiv",  // create a Diagram for the DIV HTML element
          { // enable undo & redo
            "undoManager.isEnabled": true,
            layout: new go.TreeLayout({
              angle: 90,
              layerSpacing: 35,
            })
          });

      // define a simple Node template
      myDiagram.nodeTemplate =
        $(go.Node, "Auto",  // the Shape will go around the TextBlock
          $(go.Shape, "Rectangle",
            { width: 200, height: 40, fill: "white" },  // default fill is white
            // Shape.fill is bound to Node.data.color
            new go.Binding("fill", "color")),
          $(go.TextBlock,
            { margin: 8 },  // some room around the text
            // TextBlock.text is bound to Node.data.key
            new go.Binding("text", "key")),
          $(go.TextBlock,
            { margin: 16 },  // some room around the text
            // TextBlock.text is bound to Node.data.key
            new go.Binding("text", "value"))
        );

      // but use the default Link template, by not setting Diagram.linkTemplate



      // create the model data that will be represented by Nodes and Links
      myDiagram.model = new go.TreeModel(
        [
          { key: "1",              value: "Don Meow"   },
          { key: "2", parent: "1", value: "Demeter"   },
          { key: "3", parent: "1", value: "Copricat"    },
          { key: "4", parent: "3", value: "Jellylorum"  },
          { key: "5", parent: "3", value: "Alonzo"      },
          { key: "6", parent: "2", value: "Munkustrap"  }
        ]);
    }
  },
  mounted() {
    this.chart1();
  }
})
</script>

<style scoped>
#myDiagramDiv {
  width: 100%;
  height: 500px;
}
</style>
