Check list làm modulde User với chức năng phân quyền

1. Tạo dự án
2. Tạo login và register bằng thư viện auth
3. Tạo Database với 5 table làm phân quyền
 -- users: id, name, email, password, created_at, updated_at (Lưu thông tin user login, register vào hệ thống)
 -- roles: id, name, display_name, created_at, updated_at (Lưu các vai trò của user trong hệ thống ; vd: Quyền quản trị hệ thống, khách hàng, nhà phát triển, chỉnh sửa..)
 ----user_role: id, user_id, role_id, created_at, updated_at  // Bảng trung gian kết nối users table và roles table (many to many)
 -- permission: id, name, display_name, created_at, updated_at (Lưu trữ các quyền ; vd: post.add , post.edit, post.delete)
 ---- permission_role: id, role_id, permission_id, created_at, updated_at // Bảng trung gian kết nối roles table và permission table (many to many)
 4. Tạo các route
 5. Tạo giao diện quản lý
 6. Đổ dữ liệu lên module users