<?php
	
	namespace App\Http\Controllers;
	
	use Illuminate\Http\Request;
	use App\Groups;
	use App\Options;
	use App\Elections;
	use App\User;
	use Illuminate\Support\Facades\Auth;
	use Illuminate\Support\Facades\Hash;
	use Carbon\Carbon;
	use Illuminate\Support\Facades\DB;
	
	class DefaultController extends Controller
	{
		public function index(Request $request)
		{
			$groups = Groups::orderByRaw('sort,id desc')->get();
			$group_ids = Groups::orderByRaw('sort,id desc')->pluck('id');
			$options = Options::all();
			$elections = Elections::orderByRaw('sort,id desc')->get();
			return view('welcome' , compact(['options']))->with([ 'elections' => $elections, 'groups' => $groups, 'group_ids' => $group_ids ]);
		}
		
		public function show($group_ids)
		{
			$groups = Groups::orderByRaw('sort,id desc')->get();
			$options = Options::all();
			$elections = Elections::orderByRaw('sort,id desc')->get();
			return view('show' , compact(['options']))->with([ 'elections' => $elections, 'groups' => $groups, 'group_ids' => $group_ids ]);
		}
		
		public function profile($group)
		{
			$elections = null;
			if($group == "home")
				$group = null;
			
			if(isset($group)){
				$group = Groups::find($group);
				$elections = Elections::where('group_id',$group->id)->orderByRaw('sort,id desc')->get();
			}
			$groups = Groups::orderByRaw('sort,id desc')->get();
			$options = Options::all();
			$user = Auth::user();
			return view('auth.profile' , compact(['options']))->with([ 'elections' => $elections, 'user' => $user , 'groups' => $groups, 'group' => $group ]);
		}
		
		public function groupcreate(Request $request)
		{
			$group = Groups::create([
            'title' => $request['title'],
            'graphic' => $request['graphic'],
            'show_count' => $request['show_count'],
            'total_rate' => $request['total_rate'],
            'invalid_rate' => $request['invalid_rate'],
			]);
			$group->save();
			
			return redirect()->route('profile',['group'=>$group->id])->with(['success'=>'İşlem başarıyla tamamlanmıştır.']);
    
		}
		
		public function groupupdate(Request $request)
		{
			$group = Groups::find($request["id"]);
			if($group != null){
				$group->fill($request->all());
				$group->save();
				
				return $group;
			}
			return "";
		}
		
		public function groupdelete($id)
		{
			$group = Groups::find($id);
			
			if($group != null){
				
				$elections = Elections::where('group_id',$group->id)->orderByRaw('sort,id desc')->get();
				foreach($elections as $item){
					$item->delete();
				}
				$group->delete();
				
				return "success";
			}
			return "error";
		}
			
		public function groupsort(Request $request)
		{
			$items = $request->get('ids');
			$counter = 0;
			foreach($items as $item){
				$item = Groups::findOrFail($item);
				$item->sort = $counter;
				$item->save();
				$counter++;
		   }
			return 'success';  
		}
		
		public function profileupdate(Request $request)
		{
			$request["password"] = Hash::make($request["password"]);
			$user = User::find(Auth::user()->id);
			$user->fill($request->all())->save();
			return redirect()->route('profile',['group'=>'home'])->with(['success'=>'İşlem başarıyla tamamlanmıştır.']);
		}
		
		public function data($group)
		{
			$result['data'] = [];
			$result['title'] = "Sonuç Ekranı";
			$result['graphic'] = "true";
			$result['show_count'] = 6;
			$result['total'] = "";
			if(isset($group)){
				$group = Groups::find($group);
				$result = array();
				$data = array();
				$total = Elections::where("group_id",$group->id)->value(DB::raw("SUM(rate1 + rate2 + rate3 + rate4 + rate5 + rate6 + rate7 + rate8 + rate9 + rate10 + rate11 + rate12 + rate13 + rate14 + rate15 + rate16 + rate17 + rate18 + rate19 + rate20)"));
				//$total = Elections::select(DB::raw("SUM(rate1 + rate2 + rate3 + rate4 + rate5 + rate6 + rate7 + rate8 + rate9 + rate10 + rate11 + rate12) as sumval"))->where("group_id",$group->id)->value('sumval');
				$elections = Elections::where("group_id",$group->id)->orderByRaw('(rate1 + rate2 + rate3 + rate4 + rate5 + rate6 + rate7 + rate8 + rate9 + rate10 + rate11 + rate12 + rate13 + rate14 + rate15 + rate16 + rate17 + rate18 + rate19 + rate20) desc')->get();
				$counter = 1;
				foreach($elections as $item){
					$rate = $item->rate1 + $item->rate2 + $item->rate3 + $item->rate4 + $item->rate5 + $item->rate6 + $item->rate7 + $item->rate8 + $item->rate9 + $item->rate10 + $item->rate11 + $item->rate12 + $item->rate13 + $item->rate14 + $item->rate15 + $item->rate16 + $item->rate17 + $item->rate18 + $item->rate19 + $item->rate20;
					$sub_item = array();
					$sub_item["counter"] = $counter;
					$sub_item["color"] = $item->color;
					$sub_item["detail"] = $item->detail;
					$sub_item["title"] = $item->title;
					$sub_item["image"] = $item->image;
					$sub_item["rate-total"] = $rate. " - " . $total;
					$sub_item["percent"] = ( $rate == 0 ? 0 : number_format((($rate / $total) * 100), 2, '.', ''));
					$sub_item["rate1"] = $item->rate1;
					$sub_item["rate2"] = $item->rate2;
					$sub_item["rate3"] = $item->rate3;
					$sub_item["rate4"] = $item->rate4;
					$sub_item["rate5"] = $item->rate5;
					$sub_item["rate6"] = $item->rate6;
					$sub_item["rate7"] = $item->rate7;
					$sub_item["rate8"] = $item->rate8;
					$sub_item["rate9"] = $item->rate9;
					$sub_item["rate10"] = $item->rate10;
					$sub_item["rate11"] = $item->rate11;
					$sub_item["rate12"] = $item->rate12;
					$sub_item["rate13"] = $item->rate13;
					$sub_item["rate14"] = $item->rate14;
					$sub_item["rate15"] = $item->rate15;
					$sub_item["rate16"] = $item->rate16;
					$sub_item["rate17"] = $item->rate17;
					$sub_item["rate18"] = $item->rate18;
					$sub_item["rate19"] = $item->rate19;
					$sub_item["rate20"] = $item->rate20;
					
					for ($i = 1; $i <= 20; $i++) {
						if(strlen($sub_item["rate".$i])==0){
							$sub_item["rate".$i] = 0;
						}
					}
					$sub_item["total"] = $rate;
					$data[] = $sub_item;
					$counter++;
				}
				
				$result['data'] = $data;
				$result['title'] = $group->title;
				$result['graphic'] = $group->graphic;
				$result['show_count'] = $group->show_count;
				$result['total'] = $total;
			}
			return $result;
		}
		
		public function clonecreate($id)
		{
			$election = Elections::find($id);
			if($election != null){
				$election = $election->replicate(); 
				$election->push(); 
				return redirect()->route('profile',['group'=>$election->group_id])->with(['success'=>'İşlem başarıyla tamamlanmıştır.']);
			}
			return redirect()->route('profile',['group'=> 'home'])->with(['error'=>'Kayıt Bulunamadı']);
		}
		
		public function create(Request $request)
		{
			$image = null;
			if($request->hasFile('image')) {
				$folder = date('Y-m-d');
				if (!file_exists(public_path("uploads/" . $folder))) {
					mkdir(public_path("uploads/" . $folder));
				}
				$destinationPath = public_path('/uploads/'.$folder);
				$request_file       = $request->file('image');
				$filename    = $request_file->getClientOriginalName();
				
				if (!file_exists(public_path("uploads/" . $folder . "/" . $filename))) {
					$filename = Carbon::now()->timestamp . '-' . $filename;
				}
				
				$request_file->move($destinationPath, $filename);
				$image = 'uploads/'. $folder . '/' .$filename;
			}
			
			
			$election = Elections::create([
            'image' => $image,
            'group_id' => $request['group_id'],
            'color' => $request['color'],
            'title' => $request['title'],
            'detail' => $request['detail'],
            'rate1' => $request['rate1'],
			'rate2' => $request['rate2'],
			'rate3' => $request['rate3'],
			'rate4' => $request['rate4'],
			'rate5' => $request['rate5'],
			'rate6' => $request['rate6'],
			'rate7' => $request['rate7'],
			'rate8' => $request['rate8'],
			'rate9' => $request['rate9'],
			'rate10' => $request['rate10'],
			'rate11' => $request['rate11'],
			'rate12' => $request['rate12'],
			'rate13' => $request['rate13'],
			'rate14' => $request['rate14'],
			'rate15' => $request['rate15'],
			'rate16' => $request['rate16'],
			'rate17' => $request['rate17'],
			'rate18' => $request['rate18'],
			'rate19' => $request['rate19'],
			'rate20' => $request['rate20'],
			]);
			$election->save();
			return redirect()->route('profile',['group'=>$election->group_id])->with(['success'=>'İşlem başarıyla tamamlanmıştır.']);
		}
		
		public function update(Request $request)
		{
			$result['result'] = "error";
			$result['image'] = "";
			$result['rate'] = 0;
			$result['group'] = 0;
			$election = Elections::find($request["id"]);
			if($election != null){
				$image = $election->image;
				if($request->hasFile('image')) {
					$folder = date('Y-m-d');
					if (!file_exists(public_path("uploads/" . $folder))) {
						mkdir(public_path("uploads/" . $folder));
					}
					$destinationPath = public_path('/uploads/'.$folder);
					$request_file       = $request->file('image');
					$filename    = $request_file->getClientOriginalName();
					
					if (!file_exists(public_path("uploads/" . $folder . "/" . $filename))) {
						$filename = Carbon::now()->timestamp . '-' . $filename;
					}
					
					$request_file->move($destinationPath, $filename);
					$image = 'uploads/' . $folder . "/" . $filename;
				}
				$election->fill($request->all());
				$election->image = $image;
				$election->save();
				
				
				$group = Groups::find($election->group_id);
				$total = Elections::where("group_id",$group->id)->value(DB::raw("SUM(rate1 + rate2 + rate3 + rate4 + rate5 + rate6 + rate7 + rate8 + rate9 + rate10 + rate11 + rate12 + rate13 + rate14 + rate15 + rate16 + rate17 + rate18 + rate19 + rate20)"));

				if($total > ($group->total_rate + $group->invalid_rate)){
					$group->total_rate = $total;
					$group->save();
				}
				
				$result['result'] = "success";
				$result['image'] = $image;
				$result['rate'] = $group->total_rate;
				$result['group'] = $group->id;
				
			}
			return $result;
		}
		
		public function delete($id)
		{
			$election = Elections::find($id);
			
			if($election != null){
				
				$election->delete();
				
				return "success";
			}
			return "error";
		}
			
		public function electionsort(Request $request)
		{
			$items = $request->get('ids');
			$counter = 0;
			foreach($items as $item){
				$item = Elections::findOrFail($item);
				$item->sort = $counter;
				$item->save();
				$counter++;
		   }
			return 'success';  
		}
	}		