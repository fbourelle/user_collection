@extends('layouts.app')

@section('content')

      <div class="ui centered grid">
        <div class="sixteen wide column">
          <h5>Here are the users 👯</h5>

          @verbatim
            <div id="mygooderusers">
              <form id="search">
                <div class="inline field">
                  <div class="ui icon input">
                    <input name="queryUser" v-model="searchInUsers" placeholder="search in users">
                    <i class="search icon"></i>
                  </div>
                  <div class="ui left pointing teal label">
                      <span v-if="searchInUsers">{{ nbFilteredData }} Result<span v-if="nbFilteredData > 1">s</span></span>
                      <span v-else>Be lucky !</span>
                  </div>
                </div>
              </form>
              <users
                :data="tableData.data"
                :colonnes="tableColumns"
                :filter-key="searchInUsers">
              </users>
            </div>
          @endverbatim
        </div>
      </div>
@endsection
