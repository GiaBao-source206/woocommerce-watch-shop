<?php
// Add custom Theme Functions here

/**
 * Lab 2 - Việt hóa các chuỗi còn tiếng Anh của theme Flatsome và các plugin
 * (Flatsome / YITH Wishlist không có gói tiếng Việt chính thức).
 */
add_filter( 'gettext', 'ishop_viet_hoa', 20, 3 );
add_filter( 'gettext_with_context', function ( $t, $text, $ctx, $domain ) {
	return ishop_viet_hoa( $t, $text, $domain );
}, 20, 4 );
function ishop_viet_hoa( $translated, $text, $domain ) {
	static $map = array(
		'Quick View'              => 'Xem nhanh',
		'Add to wishlist'         => 'Thêm vào yêu thích',
		'Browse wishlist'         => 'Xem danh sách yêu thích',
		'Product added!'          => 'Đã thêm sản phẩm!',
		'The product is already in your wishlist!' => 'Sản phẩm đã có trong danh sách yêu thích!',
		'Wishlist'                => 'Yêu thích',
		'My wishlist'             => 'Danh sách yêu thích',
		'Search&hellip;'          => 'Tìm kiếm&hellip;',
		'Search…'                 => 'Tìm kiếm…',
		'Search'                  => 'Tìm kiếm',
		'Login'                   => 'Đăng nhập',
		'Register'                => 'Đăng ký',
		'Lost your password?'     => 'Quên mật khẩu?',
		'Remember me'             => 'Ghi nhớ đăng nhập',
		'Username or email address' => 'Tên đăng nhập hoặc email',
		'Password'                => 'Mật khẩu',
		'Cart'                    => 'Giỏ hàng',
		'Checkout'                => 'Thanh toán',
		'Shopping Cart'           => 'Giỏ hàng',
		'Checkout details'        => 'Thông tin thanh toán',
		'Order Complete'          => 'Hoàn tất đơn hàng',
		'Continue shopping'       => 'Tiếp tục mua sắm',
		'Related products'        => 'Sản phẩm tương tự',
		'Sale!'                   => 'Giảm giá!',
		'New'                     => 'Mới',
		'Out of stock'            => 'Hết hàng',
		'Share'                   => 'Chia sẻ',
		'Share on Facebook'       => 'Chia sẻ lên Facebook',
		'Follow on Facebook'      => 'Theo dõi trên Facebook',
		'Follow on Instagram'     => 'Theo dõi trên Instagram',
		'Send us an email'        => 'Gửi email cho chúng tôi',
		'Skip to content'         => 'Chuyển đến nội dung',
		'Menu'                    => 'Danh mục',
		'Categories'              => 'Danh mục',
		'Newsletter'              => 'Nhận tin',
		'Sign up for Newsletter'  => 'Đăng ký nhận tin',
		'Showing all %d results'  => 'Hiển thị tất cả %d kết quả',
		'Default sorting'         => 'Thứ tự mặc định',
		'Read more'               => 'Xem thêm',
		'Continue reading'        => 'Đọc tiếp',
		'Leave a comment'         => 'Để lại bình luận',
		'Posted on'               => 'Đăng ngày',
		'Previous'                => 'Trước',
		'Next'                    => 'Sau',
	);
	return isset( $map[ $text ] ) ? $map[ $text ] : $translated;
}

// Việt hóa chuỗi số nhiều (đếm kết quả sản phẩm)
add_filter( 'ngettext', function ( $t, $single, $plural, $n, $domain ) {
	if ( 'woocommerce' !== $domain ) return $t;
	$map = array(
		'Showing the single result'  => 'Hiển thị kết quả duy nhất',
		'Showing all %d result'      => 'Hiển thị tất cả %d kết quả',
		'Showing %1$d&ndash;%2$d of %3$d result' => 'Hiển thị %1$d&ndash;%2$d trong %3$d kết quả',
	);
	if ( 'Showing all %d results' === $plural && $n != 1 ) return 'Hiển thị tất cả %d kết quả';
	return isset( $map[ $single ] ) ? $map[ $single ] : $t;
}, 20, 5 );
add_filter( 'gettext_with_context', function ( $t, $text, $ctx, $domain ) {
	if ( 'Showing %1$d&ndash;%2$d of %3$d results' === $text || 'Showing %1$d&ndash;%2$d of %3$d result' === $text ) return 'Hiển thị %1$d&ndash;%2$d trong %3$d kết quả';
	return $t;
}, 21, 4 );
add_filter( 'ngettext_with_context', function ( $t, $single, $plural, $n, $ctx, $domain ) {
	if ( 'woocommerce' === $domain && false !== strpos( $plural, 'Showing %1$d' ) ) return $n == 1 ? 'Hiển thị kết quả duy nhất' : 'Hiển thị %1$d&ndash;%2$d trong %3$d kết quả';
	return $t;
}, 20, 6 );
