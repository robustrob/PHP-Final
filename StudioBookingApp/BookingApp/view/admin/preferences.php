<html>
<head>

    <?php
    $page = 'admin';
    require_once '../BookingApp/view/header.php';
    ?>

</head>
<body>
<div class="container">

    <?php require_once '../BookingApp/view/navbar.php' ?>


    <div class="scene_element--fadeinup">
        <div class="row">

            <div class="col-xs-1 col-md-2 col-lg-3"></div>
            <div class="col-xs-10 col-md-8 col-lg-6 ">

                <?= $data['error'] ?>

                <h2>Preferences</h2>

                <h3>Edit Weekly Availabilities</h3>

                <form class="form-inline" method="post" action="/admin/UpdateAvailabilities">
                    <table>
                        <tr>
                            <td>
                                <label for="StartDay">Start Day</label>&nbsp;
                            </td>
                            <td>
                                <div class="form-group">
                                    <select class="form-control" id="StartDay" name="StartDay">
                                        <option
                                            value="Monday"      <?= ($data['availabilities']['a_startday'] == 'Monday' ? 'selected' : '') ?>     >
                                            Monday
                                        </option>
                                        <option
                                            value="Tuesday"     <?= ($data['availabilities']['a_startday'] == 'Tuesday' ? 'selected' : '') ?>    >
                                            Tuesday
                                        </option>
                                        <option
                                            value="Wednesday"   <?= ($data['availabilities']['a_startday'] == 'Wednesday' ? 'selected' : '') ?>  >
                                            Wednesday
                                        </option>
                                        <option
                                            value="Thursday"    <?= ($data['availabilities']['a_startday'] == 'Thursday' ? 'selected' : '') ?>   >
                                            Thursday
                                        </option>
                                        <option
                                            value="Friday"      <?= ($data['availabilities']['a_startday'] == 'Friday' ? 'selected' : '') ?>     >
                                            Friday
                                        </option>
                                        <option
                                            value="Saturday"    <?= ($data['availabilities']['a_startday'] == 'Saturday' ? 'selected' : '') ?>   >
                                            Saturday
                                        </option>
                                        <option
                                            value="Sunday"      <?= ($data['availabilities']['a_startday'] == 'Sunday' ? 'selected' : '') ?>     >
                                            Sunday
                                        </option>
                                    </select>
                                </div>
                            </td>
                            <td>
                                &nbsp;&nbsp;&nbsp;

                                <label for="EndDay">End Day</label>&nbsp;
                            </td>
                            <td>
                                <div class="form-group">

                                    <select class="form-control" id="EndDay" name="EndDay">
                                        <option
                                            value="Monday"      <?= ($data['availabilities']['a_endday'] == 'Monday' ? 'selected' : '') ?>     >
                                            Monday
                                        </option>
                                        <option
                                            value="Tuesday"     <?= ($data['availabilities']['a_endday'] == 'Tuesday' ? 'selected' : '') ?>    >
                                            Tuesday
                                        </option>
                                        <option
                                            value="Wednesday"   <?= ($data['availabilities']['a_endday'] == 'Wednesday' ? 'selected' : '') ?>  >
                                            Wednesday
                                        </option>
                                        <option
                                            value="Thursday"    <?= ($data['availabilities']['a_endday'] == 'Thursday' ? 'selected' : '') ?>   >
                                            Thursday
                                        </option>
                                        <option
                                            value="Friday"      <?= ($data['availabilities']['a_endday'] == 'Friday' ? 'selected' : '') ?>     >
                                            Friday
                                        </option>
                                        <option
                                            value="Saturday"    <?= ($data['availabilities']['a_endday'] == 'Saturday' ? 'selected' : '') ?>   >
                                            Saturday
                                        </option>
                                        <option
                                            value="Sunday"      <?= ($data['availabilities']['a_endday'] == 'Sunday' ? 'selected' : '') ?>     >
                                            Sunday
                                        </option>
                                    </select>
                                </div>
                                <br/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="StartTime">Start Time</label>&nbsp;
                            </td>
                            <td>
                                <div class="form-group">

                                    <input type="time" class="form-control" id="StartTime" name="StartTime"
                                           value="<?= $data['availabilities']['a_starttime'] ?>"/>
                                </div>
                            </td>

                            <td>
                                &nbsp;&nbsp;&nbsp;
                                <label for="EndTime">End Time</label>&nbsp;
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="time" class="form-control" id="EndTime" name="EndTime"
                                           value="<?= $data['availabilities']['a_endtime'] ?>"/>
                                </div>

                            </td>
                        </tr>

                    </table>


                    <button type="submit" name="SaveAvailabilities" class="btn btn-default">Save Weekly Availabilities
                    </button>
                </form>


                <br/><br/><br/>
                <h3>Rules</h3>



                <form class="form-horizontal"  method="post" action="/admin/UpdateRules">
                    <div class="form-group">
                        <label for="minPayment" class="col-xs-3 control-label">Minimum Payment ($)</label>
                        <div class="col-xs-9">
                            <input type="number" step="0.01" class="form-control" name="minPayment" value="<?= $data['rules']['r_min_payment']?>" id="minPayment" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="maxSessions" class="col-xs-3 control-label">Maximum Sessions / day</label>
                        <div class="col-xs-9">
                            <input type="number" class="form-control" name="maxSessions" value="<?= $data['rules']['r_max_sessions']?>" id="maxSessions" >
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-offset-3 col-xs-9">
                            <button type="submit" name="save" class="btn btn-default">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>


</body>
</html>