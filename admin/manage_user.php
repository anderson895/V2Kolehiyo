<?php
include "components/header.php";

include('../includes/db.php'); 


?>

<!-- Admin Card -->
<div class="flex justify-between items-center bg-white p-6 mb-6 rounded-md shadow-md">
    <h2 class="text-xl font-semibold text-gray-700">Admin</h2>
    <div class="w-12 h-12 bg-gray-300 rounded-full flex items-center justify-center text-xl font-bold text-white">
        <?php
        echo substr(ucfirst($_SESSION['username']), 0, 1);
        ?>
    </div>
</div>

<!-- User Table Card -->
<div class="bg-white rounded-lg shadow-lg p-6 mb-6">

    <!-- Add New Button -->
    <button id="adduserButton" class="bg-blue-500 text-white py-2 px-4 text-sm rounded-lg flex items-center hover:bg-blue-600 transition duration-300 mb-4">
        <span class="material-icons mr-2 text-base">person_add</span>
        Add New
    </button>

    <!-- Table Wrapper for Responsiveness -->
    <div class="overflow-x-auto">
        <table id="userTable" class="min-w-full text-sm text-left text-gray-500 dark:text-gray-400 border-collapse">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="p-3 text-sm font-semibold">ID</th>
                    <th class="p-3 text-sm font-semibold">Username</th>
                    <th class="p-3 text-sm font-semibold">Home Sec</th>
                    <th class="p-3 text-sm font-semibold">About Me</th>
                    <th class="p-3 text-sm font-semibold">About Me Paragraph</th>
                    <th class="p-3 text-sm font-semibold">Skill 1</th>
                    <th class="p-3 text-sm font-semibold">Skill 2</th>
                    <th class="p-3 text-sm font-semibold">Skill 3</th>
                    <th class="p-3 text-sm font-semibold">Profile</th>
                    <th class="p-3 text-sm font-semibold">Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
                // Fetch all user data from the users table
                $query = "SELECT * FROM users";
                $stmt = $dsn->prepare($query);
                $stmt->execute();
                $result = $stmt->get_result();
                $fetch_all_user = $result->fetch_all(MYSQLI_ASSOC);

                // Display the user data
                if ($fetch_all_user):
                    foreach ($fetch_all_user as $user):
                ?>
                        <tr class="border-b hover:bg-gray-50">
                            <td class="p-2"><?php echo htmlspecialchars($user['users_id']); ?></td>
                            <td class="p-2"><?php echo htmlspecialchars($user['user_name']); ?></td>
                            <td class="p-2"><?php echo htmlspecialchars($user['home_sec']); ?></td>
                            <td class="p-2"><?php echo htmlspecialchars($user['about_me']); ?></td>
                            <td class="p-2"><?php echo htmlspecialchars($user['about_me_p']); ?><img src="../upload/<?=$user['about_me_img']?>" class="w-12 h-12 object-cover rounded-full"></td>
                            <td class="p-2"><?php echo htmlspecialchars($user['proj_img1_p']); ?><img src="../upload/<?=$user['proj_img1']?>" class="w-12 h-12 object-cover rounded-full"></td>
                            <td class="p-2"><?php echo htmlspecialchars($user['proj_img2_p']); ?><img src="../upload/<?=$user['proj_img2']?>" class="w-12 h-12 object-cover rounded-full"></td>
                            <td class="p-2"><?php echo htmlspecialchars($user['proj_img3_p']); ?><img src="../upload/<?=$user['proj_img3']?>" class="w-12 h-12 object-cover rounded-full"></td>
                            <td class="p-2"><img src="../upload/<?=$user['profile_picture']?>" class="w-12 h-12 object-cover rounded-full"></td>
                            
                            <td class="p-2 space-x-2">
                                <button class="bg-blue-500 text-white py-1 px-3 rounded-md hover:bg-blue-600 transition duration-300 togglerUpdateUser" 
                                data-users_id="<?=$user['users_id']?>"
                                data-user_name="<?=$user['user_name']?>"
                                data-home_sec="<?=$user['home_sec']?>"
                                data-about_me="<?=$user['about_me']?>"
                                data-about_me_p="<?=$user['about_me_p']?>"
                                data-about_me_img="<?=$user['about_me_img']?>"
                                data-proj_img1_p="<?=$user['proj_img1_p']?>"
                                data-proj_img1="<?=$user['proj_img1']?>"
                                data-proj_img2_p="<?=$user['proj_img2_p']?>"
                                data-proj_img2="<?=$user['proj_img2']?>"
                                data-proj_img3_p="<?=$user['proj_img3_p']?>"
                                data-proj_img3="<?=$user['proj_img3']?>"
                                data-profile_picture="<?=$user['profile_picture']?>"
                                >Update</button>
                                <button class="bg-red-500 text-white py-1 px-3 rounded-md hover:bg-red-600 transition duration-300 togglerDeleteUser" data-users_id="<?=$user['users_id']?>">Delete</button>
                            </td>
                        </tr>
                <?php
                    endforeach;
                else:
                ?>
                    <tr>
                        <td colspan="10" class="p-2 text-center text-gray-500">No record found.</td>
                    </tr>
                <?php
                endif;
                ?>
            </tbody>
        </table>
    </div>
</div>






<div id="deleteUserModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center" style="display:none;">
    <div class="bg-white rounded-lg shadow-lg w-96 p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Delete this user? </h3>

        <form id="deleteuserForm">

            <div hidden class="mb-4">
                <label for="remove_users_id" class="block text-sm font-medium text-gray-700">ID</label>
                <input type="text" id="remove_users_id" name="remove_users_id" class="w-full p-2 border rounded-md" required>
            </div>


           

            <div class="flex justify-end gap-2">
                <button type="button" class="togglerremoveUserClose bg-gray-500 hover:bg-gray-600 text-white py-1 px-3 rounded-md">Cancel</button>
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white py-1 px-3 rounded-md">Delete</button>
            </div>
        </form>
    </div>
</div>



<!-- Modal for Adding Promo -->
<div id="updateUserModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center" style="display:none;">
    <div class="bg-white rounded-lg shadow-lg w-full sm:w-[700px] p-6 max-h-[90vh] overflow-auto">

      <!-- Spinner -->
      <div class="spinner" style="display:none;">
            <div class=" absolute inset-0 bg-white bg-opacity-75 flex items-center justify-center">
                <div class="w-10 h-10 border-4 border-indigo-500 border-t-transparent rounded-full animate-spin"></div>
            </div>
        </div>


        <h3 class="text-lg font-semibold text-gray-800 mb-4">Update Information</h3>

      
        <form id="updateuserForm">

            <div hidden class="mb-4">
                <label for="users_id" class="block text-sm font-medium text-gray-700">ID</label>
                <input type="text" id="users_id" name="users_id" class="w-full p-2 border rounded-md" required>
            </div>

            <div class="mb-6">
                <label for="user_name" class="block text-sm font-medium text-gray-700">Username</label>
                <input type="text" id="user_name" name="user_name" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div class="mb-6">
                <label for="password" class="block text-sm font-medium text-gray-700">New Password</label>
                <input type="password" id="password" name="password" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" >
            </div>

            <div class="mb-6">
                <label for="home_sec" class="block text-sm font-medium text-gray-700">Home Sec</label>
                <input type="text" id="home_sec" name="home_sec" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div class="mb-6">
                <label for="about_me" class="block text-sm font-medium text-gray-700">About Me</label>
                <input type="text" id="about_me" name="about_me" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div class="mb-6">
                <label for="about_me_p" class="block text-sm font-medium text-gray-700">About Me Paragraph</label>
                <input type="text" id="about_me_p" name="about_me_p" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div class="mb-6">
                <label for="about_me_img" class="block text-sm font-medium text-gray-700">About Me Image</label>
                <input type="file" id="about_me_img" name="about_me_img" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" accept="image/*" >
            </div>

            <div class="mb-6">
                <label for="proj_img1_p" class="block text-sm font-medium text-gray-700">Skill 1</label>
                <input type="text" id="proj_img1_p" name="proj_img1_p" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div class="mb-6">
                <label for="proj_img1" class="block text-sm font-medium text-gray-700">Skill 1 Image</label>
                <input type="file" id="proj_img1" name="proj_img1" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" accept="image/*" >
            </div>

            <div class="mb-6">
                <label for="proj_img2_p" class="block text-sm font-medium text-gray-700">Skill 2</label>
                <input type="text" id="proj_img2_p" name="proj_img2_p" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div class="mb-6">
                <label for="proj_img2" class="block text-sm font-medium text-gray-700">Skill 2 Image</label>
                <input type="file" id="proj_img2" name="proj_img2" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" accept="image/*" >
            </div>

            <div class="mb-6">
                <label for="proj_img3_p" class="block text-sm font-medium text-gray-700">Skill 3</label>
                <input type="text" id="proj_img3_p" name="proj_img3_p" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div class="mb-6">
                <label for="proj_img3" class="block text-sm font-medium text-gray-700">Skill 3 Image</label>
                <input type="file" id="proj_img3" name="proj_img3" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" accept="image/*" >
            </div>

            <div class="mb-6">
                <label for="profile_picture" class="block text-sm font-medium text-gray-700">Profile</label>
                <input type="file" id="profile_picture" name="profile_picture" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" accept="image/*" >
            </div>

            <div class="flex justify-end gap-4 mt-6">
                <button type="button" class="togglerUpdateUserClose bg-gray-500 hover:bg-gray-600 text-white py-2 px-4 rounded-md">Cancel</button>
                <button type="submit" id="btnUpdateUser" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-md">Update User</button>
            </div>
         
        </form>
    </div>
</div>


<!-- Modal for Adding Promo -->
<div id="addUserModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center" style="display:none;">
    <div class="bg-white rounded-lg shadow-lg w-full sm:w-[700px] p-6 max-h-[90vh] overflow-auto">

     <!-- Spinner -->
     <div class="spinner" style="display:none;">
            <div class=" absolute inset-0 bg-white bg-opacity-75 flex items-center justify-center">
                <div class="w-10 h-10 border-4 border-indigo-500 border-t-transparent rounded-full animate-spin"></div>
            </div>
        </div>


        <h3 class="text-lg font-semibold text-gray-800 mb-6 text-center">Add New User</h3>
        <form id="adduserForm">

            <div class="mb-6">
                <label for="user_name" class="block text-sm font-medium text-gray-700">Username</label>
                <input type="text" name="user_name" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div class="mb-6">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="password" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div class="mb-6">
                <label for="home_sec" class="block text-sm font-medium text-gray-700">Home Sec</label>
                <input type="text" name="home_sec" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div class="mb-6">
                <label for="about_me" class="block text-sm font-medium text-gray-700">About Me</label>
                <input type="text" name="about_me" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div class="mb-6">
                <label for="about_me_p" class="block text-sm font-medium text-gray-700">About Me Paragraph</label>
                <input type="text" name="about_me_p" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div class="mb-6">
                <label for="about_me_img" class="block text-sm font-medium text-gray-700">About Me Image</label>
                <input type="file" name="about_me_img" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" accept="image/*" required>
            </div>

            <div class="mb-6">
                <label for="proj_img1_p" class="block text-sm font-medium text-gray-700">Skill 1</label>
                <input type="text" name="proj_img1_p" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div class="mb-6">
                <label for="proj_img1" class="block text-sm font-medium text-gray-700">Skill 1 Image</label>
                <input type="file" name="proj_img1" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" accept="image/*" required>
            </div>

            <div class="mb-6">
                <label for="proj_img2_p" class="block text-sm font-medium text-gray-700">Skill 2</label>
                <input type="text" name="proj_img2_p" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div class="mb-6">
                <label for="proj_img2" class="block text-sm font-medium text-gray-700">Skill 2 Image</label>
                <input type="file" name="proj_img2" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" accept="image/*" required>
            </div>

            <div class="mb-6">
                <label for="proj_img3_p" class="block text-sm font-medium text-gray-700">Skill 3</label>
                <input type="text" name="proj_img3_p" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div class="mb-6">
                <label for="proj_img3" class="block text-sm font-medium text-gray-700">Skill 3 Image</label>
                <input type="file" name="proj_img3" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" accept="image/*" required>
            </div>

            <div class="mb-6">
                <label for="profile_picture" class="block text-sm font-medium text-gray-700">Profile</label>
                <input type="file" name="profile_picture" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" accept="image/*" required>
            </div>

            <div class="flex justify-end gap-4 mt-6">
                <button type="button" class="addUserModalClose bg-gray-500 hover:bg-gray-600 text-white py-2 px-4 rounded-md">Cancel</button>
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-md">Add New</button>
            </div>
        </form>
    </div>
</div>






<?php
include "components/footer.php";
?>
