<!DOCTYPE html>
<html>
	<head>
		<title>Yeet Telegram Registration</title>
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
					style='padding:30px;line-height: 1.7;'>
						<tr>
							<td align='center'>
                                <img width='40px' height='40px' src="{{ $message->embed(config('app.root').'/public/images/general/favicon.png') }}" />
                            </td>
						</tr>
						<tr>
							<td>
								<p style='margin:15px 0 12px 0;font-weight:bold; text-align:center'>Yeet Telegram Verification</p>
							</td>
						</tr>
						<tr>
							<td>
								<div>
									Hey there {{ $name }}. <b>{{ $code }}</b> is your Telegram verification code. Send me this code and I will complete the process
                                    of logging you in. I am very excited to help you keep track of your financial portfolio and investments.
                                    I trust we will have fun together.
								</div>
							</td>
						</tr>
                        <tr>
                            <td>
                                <div style='margin-top:15px'>
                                    <p style='margin:0;'>Your Friendly Neighborhood Bot,</p>
                                    <p style='margin:4px 0 0 0;'>Yeetbot</p>
                                </div>
                            </td>
                        </tr>
					</table>
				</td>
			</tr>
		</table>
	</body>
</html>