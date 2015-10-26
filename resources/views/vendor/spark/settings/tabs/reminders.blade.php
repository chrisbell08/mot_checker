<spark-settings-profile-screen inline-template>
    <div id="spark-settings-profile-screen" class="panel panel-default">
        <div class="panel-heading"><i class="fa fa-mobile"></i>&nbsp;SMS Reminders <button class="btn btn-info pull-right btn-xs" disabled>Remind me now</button></div>

        <div class="panel-body">
            <spark-errors form="@{{ updateProfileForm }}"></spark-errors>

            <div class="alert alert-success" v-if="updateProfileForm.updated">
                <strong>Great!</strong> Your profile was successfully updated.
            </div>

            <p>Comming Soon..</p>
        </div>
    </div>

    <div id="spark-settings-profile-screen" class="panel panel-default">
        <div class="panel-heading"><i class="fa fa-envelope-o"></i>&nbsp;Email Reminders <button class="btn btn-info pull-right btn-xs" disabled>Remind me now</button></div>

        <div class="panel-body">
            <spark-errors form="@{{ updateProfileForm }}"></spark-errors>

            <div class="alert alert-success" v-if="updateProfileForm.updated">
                <strong>Great!</strong> Your profile was successfully updated.
            </div>

            <p>Comming Soon..</p>
        </div>
    </div>
</spark-settings-profile-screen>

