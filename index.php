<?php
    $customizeJsonPath = 'customize.json';
    $customizeJsonContent = file_get_contents($customizeJsonPath);
    $customizeJson = json_decode($customizeJsonContent, true);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- SEO -->
    <title><?php echo $customizeJson['seo']['title'] ?></title>
    <meta name="desc" content="<?php echo $customizeJson['seo']['desc'] ?>">
    <?php if(!$customizeJson['seo']['crawl']){ ?>
        <meta name="robots" content="index,follow,noarchive">
    <?php } ?>
    <!-- Link -->
    <link rel="stylesheet" href="page.css">
    <link rel="stylesheet" href="assets/docs/css/main/get.css">
    <script src="https://kit.fontawesome.com/b0b871fd53.js" crossorigin="anonymous"></script>
    <script src="page.js"></script>
    <!-- Meta -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<style>
    :root {
        --colorPrimary: <?php echo $customizeJson['style']['colors']['primary'] ?>;
        --colorPrimaryLight: <?php echo $customizeJson['style']['colors']['primaryLight'] ?>;
    }
</style>
<body>
    <header>
        <a href="."><h1><?php echo $customizeJson['panel']['name'] ?></h1></a>
    </header>
    <!-- <a onclick="alert('This is an alert dialog box')"><i class="far fa-newspaper"></i> Neuigkeit</a>
    <a onclick="alert('This is an alert dialog box')"><i class="far fa-chalkboard"></i> Dashboard</a></div> -->
    <main>
        <nav>
            <div class="main">
                <?php foreach ($customizeJson['panel']['tabs'] as $tab) {
                    echo '<a onclick="window.alert('."'Feature Update Soon'".');"><i class="far '.$tab['faIcon'].'"></i> '.$tab['title'].'</a>';
                }?>
            </div>
            <?php if(isset($customizeJson['panel']['support'])) { ?>
            <div class="more">
                <a href="<?php echo $customizeJson['panel']['support'] ?>"><?php echo $customizeJson['panel']['supportName'] ?></a>
            </div>
            <?php } ?>
        </nav>
        <section id="content">
            <?php $startTap = $customizeJson['panel']['startTabArray'] ?>
            <h3><i class="far <?php echo $customizeJson['panel']['tabs'][$startTap]['faIcon'] ?>"></i> <?php echo $customizeJson['panel']['tabs'][$startTap]['title'] ?></h3>
            <section id="table">
                <table>
                    <thead>
                        <tr>
                            <?php foreach ($customizeJson['panel']['table']['columns'] as $column) {
                                echo '<th>'.$column['title'].'</th>';
                            }?>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                <div id="loadingElement">
                    <div class="customEasySpinner"></div>
                </div>
            </section>
        </section>
    </main>
    <script type="module">
        let table = document.querySelector('table tbody');
        let loadingElement = document.getElementById('loadingElement');

        // Import firebase scripts
        import { initializeApp } from 'https://www.gstatic.com/firebasejs/9.5.0/firebase-app.js';
        import { getFirestore, collection, getDocs, addDoc, deleteDoc } from 'https://www.gstatic.com/firebasejs/9.5.0/firebase-firestore.js';

        // Config firebase connection
        const firebaseConfig = {
            apiKey: "<?php echo $customizeJson['firebase']['apiKey'] ?>",
            authDomain: "<?php echo $customizeJson['firebase']['authDomain'] ?>",
            projectId: "<?php echo $customizeJson['firebase']['projectId'] ?>"
        };

        // Initialize connection
        const app = initializeApp(firebaseConfig);
        const db = getFirestore(app);
        
        // Fill the table on the site
        const querySnapshot = await getDocs(collection(db, "users"));
        querySnapshot.forEach((doc) => {
            addTableRow([
                <?php
                    $fillTableDocs = "";
                    foreach ($customizeJson['panel']['table']['columns'] as $column) {
                        $fillTableDocs.="doc.data()['".$column['docData']."'],";
                    }
                    substr($fillTableDocs, 0, -1);
                    echo $fillTableDocs;
                ?>
            ], table, true);
        });
        loadingElement.style.display = 'none';
    </script>
</body>
</html>