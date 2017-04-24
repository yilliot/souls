# how to use enums

***************************
use App\Enums\Categories;

Categories::getObj(Categories::random())
    ->getGroup()
    ->getName()

***************************
use App\Enums\Categories;
use App\Enums\CategoryGroups;

@foreach (CategoryGroups::getObj(CategoryGroups::random())->getCategories() as $id)
    <div>{{Categories::getObj($id)->getName()}}</div>
@endforeach
