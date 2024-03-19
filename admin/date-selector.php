<form   class="mb-3" method="post">
<style>
    .input-group-text {
        padding: 9px;
    }
</style>
        <div class="d-flex align-items-center justify-content-end flex-wrap text-nowrap">

            <div class="input-group align-items-center flatpickr wd-250 me-2 mb-2 mb-md-0">
                <label style="margin-right: 10px;">From :</label>
                <span class="input-group-text input-group-addon bg-transparent border-primary"><i data-feather="calendar" class="text-primary"></i></span>
                <input type="date" value="<?= (isset($_POST['datefrom'])) ?''.$_POST['datefrom'].'': ''.$_GET['datefrom'].''; ?>" name="datefrom" id="" class="form-control bg-transparent border-primary" placeholder="Select date" required>
            </div>
            <div class="input-group align-items-center flatpickr wd-250 me-2 mb-2 mb-md-0">
                <label style="margin-right: 10px;">To :</label>
                <span class="input-group-text input-group-addon bg-transparent border-primary"><i data-feather="calendar" class="text-primary"></i></span>
                <input type="date" name="dateto" value="<?= (isset($_POST['dateto'])) ?''.$_POST['dateto'].'': ''.$_GET['dateto'].''; ?>" id="" class="form-control bg-transparent border-primary" placeholder="Select date" required>
            </div>
            <div class="input-group align-items-center flatpickr wd-50 me-2 mb-2 mb-md-0">
                <button type="submit" class="btn btn-primary" id="">Check</button>
            </div>

        </div>
    </form>