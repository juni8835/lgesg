<?php

use app\core\App;
use app\core\Config;
use app\core\Database;
use app\core\Validator;
use app\facades\DirectorySnapshotLoader;
use app\facades\Storage;
use app\models\Test;
use app\services\pagination\SimplePaginatorRenderer;

include_once $_SERVER['DOCUMENT_ROOT'].'/app/boot.php';

$this->setLayout('admin');


// dd(DirectorySnapshotLoader::load(base_path('app')));

// $appFiles = DirectorySnapshotLoader::load(base_path('app'));
// $configFiles = DirectorySnapshotLoader::load(basename('config'));
// dd('[App] : '. $appFiles . '<br>' . '[Config] : '. $configFiles );

if(App::$app->request->getMethod() === 'POST') {
    $vt = App::$app->request->validate([
        'label' => 'required|min:5', 
        'contents' => 'required|max:10'
    ]);

    if($vt->fails()){
        // dd($vt->errors());
    } else {
        // dd($vt->validated());
    }
    dd($vt);


    // $fileinfo = App::$app->request
    //                 ->store('file'); 
    // dd($fileinfo);

    // $fileinfo = Storage::put(
    //         $_FILES['file']['name'], 
    //         file_get_contents($_FILES['file']['tmp_name'])
    // );

    
}
// $isDeleted = Storage::delete('6770d7666db699.85606404.svg');
// dd($isDeleted);


// [name] => 6770d7666db699.85606404.svg
// [path] => /Users/jangjun/Desktop/nineonelabs/nineonelabs-app/storage/cache/6770d7666db699.85606404.svg
// [src] => /storage/cache/6770d7666db699.85606404.svg
// [size] => 1309
// [type] => image/svg+xml


$rs = Database::fetchAll('select * from tests');

// $validatedData = $vt->validate();
// dd($validatedData, $vt->fails(), $vt->errors());


$directory = base_path(); // 또는 다른 디렉토리 경로

// 전체 용량 (바이트 단위)
$totalSpace = disk_total_space($directory);

// 여유 공간 (바이트 단위)
$freeSpace = disk_free_space($directory);

// 사용 중인 공간 (전체 용량 - 여유 공간)
$usedSpace = $totalSpace - $freeSpace;
$percentSpace = $freeSpace / $totalSpace * 100; 

// 용량을 GB로 변환
$totalSpaceGB = $totalSpace / 1024 / 1024 / 1024;
$freeSpaceGB = $freeSpace / 1024 / 1024 / 1024;
$usedSpaceGB = $usedSpace / 1024 / 1024 / 1024;

echo "Percent : " . number_format($percentSpace, 2) . '%';
echo "Total space: " . number_format($totalSpaceGB, 2) . " GB\n";
echo "Free space: " . number_format($freeSpaceGB, 2) . " GB\n";
echo "Used space: " . number_format($usedSpaceGB, 2) . " GB\n";


$paginator = Test::paginate($_GET['page'] ?? 1, 3);
$simpleRenderer = new SimplePaginatorRenderer($paginator);

$pageData = $paginator->toArray();
$posts = $pageData['data'];
// dd($posts);

?>

<form method="post" enctype="multipart/form-data">
    <label for="label">라벨</label>
    <input type="text" name="label">

    <label for="contents">컨텐츠</label>
    <textarea name="contents" id="contents"></textarea>

    <label for="file">파일</label>
    <input type="file" name="file" id="file">

    <div>
        <button type="submit">전송</button>
    </div>
</form>

<h2>Content</h2>
<p>Here is the paginated content:</p>

<?php if (!empty($posts)) : ?>
    <ul>
        <?php foreach ($posts as $post) : ?>
            <li>
                <a href="<?= base_url('view.php?id=' . $post['id']) ?>" class="no-link">
                    <h2><?= $post['_no'] ?> | <?= htmlspecialchars($post['label']) ?></h2>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else : ?>
    <p>No posts found.</p>
<?php endif; ?>

<?php

// echo new InputPaginatorRenderer($paginator)->render();

echo $simpleRenderer->render();
// dd($paginator);
?>

