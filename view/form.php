<div class="card shadow mt-5">
    <div class="card-header">
        <h2 style="color: #3e3e3e;">Add New Event</h2>
    </div>
    <div class="card-body py-5">
        
        <?php if(isset($success)){
            printf('<div class="alert alert-success" role="alert">%s</div>',$success);
        } ?>
        <form method="POST" action="/">
            <div class="mb-4">
                <input type="text" name="title" class="form-control py-3" placeholder="Event Title">
                <div class="invalid-feedback d-block"><?= $errors['title']??'' ?></div>
            </div>
            <!-- date group -->
            <div class="mb-3 row">
                <label class="col-8" for="start">Start Date
                    <input
                    type="date"
                    name="start"
                    id="start"
                    class="form-control">
                    <div class="invalid-feedback d-block"><?= $errors['start']??'' ?></div>
                </label>
                
                <label class="col-4" for="start_time">Start Time
                    <input
                    type="time"
                    name="start_time"
                    id="start_time"
                    class="form-control">
                     <div class="invalid-feedback d-block"><?= $errors['start_time']??'' ?></div>
                </label>
               
            </div>
            <!-- date group -->
            <div class="mb-3 row">
                <label class="col-8" for="end">End Date
                    <input
                    type="date"
                    name="end"
                    id="end"
                    class="form-control">
                    <div class="invalid-feedback d-block"><?= $errors['end']??'' ?></div>
                </label>
                
                <label class="col-4" for="end_time">End Time
                    <input
                    type="time"
                    name="end_time"
                    id="end_time"
                    class="form-control">
                    <div class="invalid-feedback d-block"><?= $errors['end_time']??'' ?></div>
                </label>
                
            </div>
            <!-- All days checkbox -->
            <div class="form-check mb-4">
                <input name="all_day" class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                <label class="form-check-label" for="flexCheckChecked">
                    All Day
                </label>
            </div>
            <!-- Events Descrption -->
            <div class="mb-3">
                <label for="description">Description <span class="text-secondary">(optional)</span></label>
                <textarea name="description" class="form-control" id="description" rows="4"></textarea>
            </div>
            <div class="mt-3">
                <input type="submit" value="Save Event" class="btn btn-sm btn-outline-dark">
            </div>
        </form>
    </div>
</div>
