<div class="col-xl-3 col-lg-3 col-md-4 col-12 mb-4 mb-lg-0">
  <form action="{{route('course.filter')}}" method="POST">
  @csrf
  <div class="card">
    <!-- Card header -->
    <div class="card-header">
      <div class="row">
        <div class="col-md-6">
          <h4 class="mb-0">Filter</h4>
        </div>
        <div class="col-md-6" style="text-align: right;">
          <button class="btn btn-primary btn-xs" type="submit">Apply</button>
        </div>
      </div>
    </div>
    <!-- Card body -->
    <div class="card-body">
      <span class="dropdown-header px-0 mb-2"> Category</span>
      <!-- Checkbox -->
      @if(!empty($categories))
      @foreach($categories as $cat)
      <div class="form-check mb-1">
        <input type="checkbox" class="form-check-input" id="{{$cat->id}}-check" name="category[]" value="{{$cat->id}}">
        <label class="form-check-label" for="{{$cat->id}}-check">{{$cat->name}}</label>
      </div>
      @endforeach
      @endif
    </div>
 
    <!-- Card body -->
    <div class="card-body border-top">
      <span class="dropdown-header px-0 mb-2"> Skill Level</span>
       <!-- Checkbox -->
      <div class="form-check mb-1">
        <input type="checkbox" class="form-check-input" id="beginnerTwoCheck" name="levels[]" value="Beginner">
        <label class="form-check-label" for="beginnerTwoCheck">Beginner</label>
      </div>
       <!-- Checkbox -->
      <div class="form-check mb-1">
        <input type="checkbox" class="form-check-input" name="levels[]" id="intermediateCheck" value="Intermediate">
        <label class="form-check-label" for="intermediateCheck">Intermediate</label>
      </div>
       <!-- Checkbox -->
      <div class="form-check mb-1">
        <input type="checkbox" class="form-check-input" name="levels[]" id="AdvancedTwoCheck" value="Advance">
        <label class="form-check-label" for="AdvancedTwoCheck">Advance</label>
      </div>
      <!-- Checkbox -->
      <div class="form-check mb-1">
        <input type="checkbox" class="form-check-input" id="allTwoCheck" name="levels[]" value="All">
        <label class="form-check-label" for="allTwoCheck">All Level</label>
      </div>
    </div>
  </div>
  </form>
</div>