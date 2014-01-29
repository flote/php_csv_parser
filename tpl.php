<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link rel="stylesheet" href="css/css.css" type="text/css" >
    <link rel="stylesheet" href="css/bootstrap.css" type="text/css" >
    <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
    <script language="JavaScript" src="js/bootstrap.js"></script>

</head>
<body>
    <div class="container">
        <div class="row">
            <div class="span12">
                <b>Filinställningar</b><br>

                <table class='table' style="width:300px;">
                    <tr>
                        <th>Fält</th>
                        <th>Aktivt</th>
                        <th>1</th>
                        <th>2</th>
                        <th>3</th>
                    </tr>
                    <tr>
                        <td><label for="first_name">Förnamn</label></td>
                        <td><input type='checkbox' checked='checked' id='first_name' name='first_name' /></td>
                        <td><input type='radio' name='first_name_order' value='1'  checked='checked'></td>
                        <td><input type='radio' name='first_name_order' value='2'></td>
                        <td><input type='radio' name='first_name_order' value='3'></td>
                    </tr>
                    <tr>
                        <td><label for="last_name">Efternamn</label></td>
                        <td><input type='checkbox' checked='checked' id='last_name' name='last_name' /></td>
                        <td><input type='radio' name='last_name_order' value='1'></td>
                        <td><input type='radio' name='last_name_order' value='2'  checked='checked'></td>
                        <td><input type='radio' name='last_name_order' value='3'></td>
                    </tr>
                    <tr>
                        <td><label for="email">E-post</label></td>
                        <td><input type='checkbox'  checked='checked' id='email' name='email' /></td>
                        <td><input type='radio' name='email_order' value='1'></td>
                        <td><input type='radio' name='email_order' value='2'></td>
                        <td><input type='radio' name='email_order' value='3'  checked='checked'></td>
                    </tr>
                    <tr>
                        <td>
                            Kolumnavgränsare
                        </td>
                        <td colspan='4'>
                            <select name='delimiter'>
                                <option value='auto'>Auto</option>
                                <option value='csv'>Komma (,)</option>
                                <option value='semi'>Komma (;)</option>
                                <option value='tab'>Tab (&#187;)</option>
                            </select>
                        </td>
                    </tr>
                </table>
                <div id='csv-holder'>
                    <b>Klasslista (CSV):</b>
                    <textarea id='users-bulk-users' name='csv_list' class='big-ol-text'></textarea>
                </div>
                <div id='results-holder'></div>
                <div class='form-actions'>
            <span id="users-bulk-test" class="btn btn-info action-hero" former='#profile-email-form' special='test-list'>
                <i class="icon-th-list icon-white"></i>
                <span>Testa lista</span>
            </span>
            <span id="users-bulk-submit" class="btn btn-danger btn-inactive action-hero" former='#profile-email-form' special='submit-verify'>
                <i class="icon-ok icon-white"></i>
                <span id='user-add-button'>Lägg till användare</span>
            </span>
            <span id="users-bulk-return" class="btn btn-inactive action-hero" former='#profile-email-form' special='back-to-form'>
                <i class="icon-refresh icon-white"></i>
                <span>Återgå till formulär</span>
            </span>
            <span id="users-bulk-reset" class="btn btn-warning">
                <i class="icon-remove icon-white"></i>
                <span>Återställ</span>
            </span>
                    <input type="submit" class="invis" />
                </div>
            </div>
        </div>
    </div>

</body>
</html>