<template>
  <table class="ui celled teal table">
    <thead>
    <tr>
      <th v-for="key in colonnes"
          @click="rankBy(key)"
          :class="{ active: sortKey == key }"
          v-bind:title="'rank ' + message">
          <i class="material-icons" v-bind:class="classObject">arrow_right_alt</i>
          {{ key }}
      </th>
      <th>Edit</th>
    </tr>
    </thead>
    <tbody>
            <userline v-for="user in filteredData"
                       :key="user.id"
                       :userData="user">
            </userline>
    </tbody>
    <tfoot>
      <tr><th colspan="6">
          <div class="ui right floated pagination menu" >
            <a class="icon item" @click="firstPage" title="first page">
              <i class="material-icons" >
                first_page
              </i>
            </a>
            <a class="item" v-for="n in pageCount+1"
                @click="goToPage(n-1)"
                :class="{ active: pageNumber == n-1 }"
                v-bind:title="'page ' + n">
                {{ n }}
            </a>
            <a class="icon item" @click="lastPage" title="last page">
              <i class="material-icons">
                  last_page
              </i>
            </a>
          </div>
        </th>
      </tr>
    </tfoot>
  </table>
</template>

<script>
  module.exports = {
    props: {
        data: Array,
        colonnes: Array,
        filterKey: String
    },
    data: function () {
        return {
            minToMax: true,
            message: 'ascending',
            sortKey: '',
            pageNumber: 0,
            size: 50,
            paginatedData: [],
        }
    },
    computed: {
        pageCount(){
            let l = this.paginatedData.length,
                s = this.size;
            return Math.floor(l/s);
        },
        filteredData(){
            const filterKey = this.filterKey && this.filterKey.toLowerCase();
            let data = this.data;
            this.paginatedData = data;
                if (filterKey) {
                    data = data.filter(function (row) {
                        return Object.keys(row).some(function (key) {
                            return String(row[key]).toLowerCase().indexOf(filterKey) > -1
                        });
                    });
                    this.paginatedData = data;
                }
            const start = this.pageNumber * this.size;
            const end = start + this.size;
            return data.slice(start, end);
        },
        classObject: function () {
            return {
                asc: this.minToMax,
                desc: !this.minToMax
            }
        }
    },
    methods: {
        goToPage(nb){
            this.pageNumber = nb;
        },
        lastPage(){
            this.pageNumber = this.pageCount;
         },
        firstPage(){
            this.pageNumber = 0;
        },
        rankBy: function (key) {
            this.sortKey = key;
            if (this.minToMax === true) {
                if (this.sortKey === 'id') {
                    var sortKey = this.sortKey;
                    this.data.sort(function (a, b) {
                        return a[sortKey] - b[sortKey];
                    });
                } else {
                    var sortKey = this.sortKey;
                    this.data.sort(function (a, b) {
                        return a[sortKey].localeCompare(b[sortKey]);
                    });
                }
                this.minToMax = false;
                this.message = 'descending';
            } else {
                if (this.sortKey === 'id') {
                    var sortKey = this.sortKey;
                    this.data.sort(function (a, b) {
                        return b[sortKey] - a[sortKey];
                    });
                } else {
                    var sortKey = this.sortKey;
                    this.data.sort(function (a, b) {
                        return b[sortKey].localeCompare(a[sortKey]);
                    });
                }
                this.minToMax = true;
                this.message = 'ascending';
            }
        }
    }
  }
</script>
