<template>
    <div>
        <slot v-bind="{ items, facilities, addRow, deleteRow, removeSelectedItem }" />
    </div>
</template>

<script>
import Vue from 'vue';  // Add this line to import Vue

const { nextTick } = Vue

export default {
    data: function () {
        return {
            items: [{ id: '', name_title: '' }],
        }
    },
    mounted() {
        if (this.selected_facilities.length) {
            this.items = []
            for (const item of this.selected_facilities) {
                this.items.push({ id: item.id, name_title: item.name_title })
            }
        }
    },
    props: {
        selected_facilities: {
            type: Array,
            default: () => [],
        },
        facilities: {
            type: Array,
            default: () => [],
        },
    },

    methods: {
        addRow: function () {
            this.items.push({ id: '', name_title: '' })

            nextTick(() => {
                if (window.kamruldashboard) {
                    window.kamruldashboard.initResources()
                }
            })
        },
        deleteRow: function (index) {
            this.items.splice(index, 1)
        },
        removeSelectedItem: function () {
            for (let i = 0; i < this.facilities.length; i++) {
                for (const item of this.items) {
                    if (item.id === this.facilities[i].id) {
                        this.facilities.slice(i, 1)
                    }
                }
            }
        },
    },
}
</script>
