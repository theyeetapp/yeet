<!DOCTYPE html>
<html>
	<head>
		<title>Trim Activation</title>
		<style type='text/css'>
			@import url('https://fonts.googleapis.com/css2?family=Quicksand&display=swap');
            
            .table__parent
            {
                padding:50px;
            }

			@media(max-width:610px)
			{
                .table__parent
                {
                    padding:10px;
                }

				.table__main
				{
					width:100%;
				}
			}
		</style>
	</head>
	<body style='margin:0; padding:0; font-family:"Quicksand", "Century Gothic", "Trebuchet MS", "Verdana", sans-serif; color:#000;'>
		<table width='100%' class='table__parent' cellpadding="0" cellspacing="0" style='background:#FBFBFB;font-size:1.1em;'>
			<tr>
				<td>
					<table width='600px' class='table__main' align="center" cellpadding="0" cellspacing="0" bgcolor="white"
					style='padding:30px;'>
						<tr>
							<td align='center'>
                                <img width='40px' height='40px' src="{{ $message->embed(config('app.root').'/public/images/general/favicon.png') }}" />
                            </td>
						</tr>
						<tr>
							<td>
								<p style='margin:15px 0 12px 0;font-weight:bold; text-align:center'>Yeet Password Reset</p>
							</td>
						</tr>
						<tr>
							<td>
								<div style='line-height: 1.7; text-align:justify;'>
									Hey there {{ explode(' ', $user->name, 2)[1] }}. A password reset request was just made on your Yeet account. Click this link
                                    to continue the process. The link expires in 30 minutes.
								</div>
							</td>
						</tr>
						<tr>
							<td>
								<div style='margin:12px 0 2px 0'>
									<a href='{{ config("app.url") }}password/change/{{ $token }}' style='color:#000; font-size:1em;'>
										{{ config("app.url") }}password/change
									</a>									
								</div>
							</td>
						</tr>
						<tr>
							<td>
								<div style='margin-top:10px;'>
									Should you be unable to use the link above, simply copy and paste this link in your browser to continue the process of changing 
                                    your password.
								</div>
							</td>
                        </tr>
                        <tr>
							<td>
								<div style='margin-top:12px;'>
									<p style='margin:0; color:#000; font-size:1em;'>{{ config('app.url') }}password/change/{{ $token }}</p>
								</div>
							</td>
                        </tr>
                        <tr>
                            <td>
                                <div style='margin-top:15px'>
                                    <p style='margin:0;'>Regards,</p>
                                    <p style='margin:4px 0 0 0;'>Yeet Support</p>
                                </div>
                            </td>
                        </tr>
					</table>
				</td>
			</tr>
		</table>
	</body>
</html>