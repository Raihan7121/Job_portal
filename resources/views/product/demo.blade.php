if ($request->hasFile('image')) {
    $image = $request->file('image');
    $imageName = time() . '.' . $image->getClientOriginalExtension();
    $image->move(public_path('job_images'), $imageName);

    $sourcePath=public_path('/job_images/'.$imageName);
$manager = new ImageManager(Driver::class);
$image = $manager->read($sourcePath);

// crop the best fitting 5:3 (600x360) ratio and resize to 600x360 pixel
 $image->cover(150, 150);
 $image->toPng()->save(public_path('/job_images/thumb/'.$imageName));

 
    $job->image = $imageName;

$job->save();

session()->flash('success', 'Job add