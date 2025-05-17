<?php

namespace App\Providers;

use App\Models\SMTP;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Config;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
	/**
	 * Register any application services.
	 */
	public function register(): void
	{
		//
	}

	/**
	 * Bootstrap any application services.
	 */
	public function boot(): void
	{
		Paginator::useBootstrap();
		Blade::directive('money', function ($amount) {
			return "<?php echo number_format((float)($amount), 0, '.', ',') . ' VND'; ?>";
		});
		$mailsetting= SMTP::first();
		if(!empty($mailsetting)) {
			$data_mail=[
				'driver'=>$mailsetting->mail_mailer,
				'host'=>$mailsetting->mail_host,
				'port'=>$mailsetting->mail_port,
				'encryption'=>$mailsetting->mail_encryption,
				'username'=>$mailsetting->mail_username,
				'password'=>$mailsetting->mail_password,
				'from'=>[
					'address'=>$mailsetting->mail_from_address,
					'name'=>$mailsetting->name
				]
			];
			Config::set('mail',$data_mail);
		}
	}
}
