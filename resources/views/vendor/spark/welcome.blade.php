<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>MOT Checker</title>

    <!-- Fonts -->
    <link href='//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700' rel='stylesheet' type='text/css'>

    <!-- Styles -->
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <!-- Main Content -->
    <div class="container spark-splash-screen">
        <!-- Branding / Navigation -->
        <div class="row splash-nav">
            <div class="col-md-10 col-md-offset-1">
                <div class="pull-left splash-brand">
                    <i class="fa fa-car"></i>MOT Checker
                </div>

                <div class="navbar-header">
                    <button type="button" class="splash-nav-toggle navbar-toggle collapsed" data-toggle="collapse" data-target="#primary-nav" aria-expanded="false" aria-controls="primary-nav">
                        <span class="sr-only">Toggle navigation</span>
                        MENU
                    </button>
                </div>

                <div id="primary-nav" class="navbar-collapse collapse splash-nav-list">
                    <ul class="nav navbar-nav navbar-right inline-list">
                        <!--
                            <li class="splash-nav-link active"><a href="/features">Features</a></li>
                            <li class="splash-nav-link"><a href="/support">Support</a></li>
                        -->
                        <li class="splash-nav-link splash-nav-link-highlight"><a href="/login">Login</a></li>
                        <li class="splash-nav-link splash-nav-link-highlight-border"><a href="/register">Register</a></li>
                    </ul>
                </div>

                <div class="clearfix"></div>
            </div>
        </div>

        <!-- Inspiration -->
        <div class="row splash-inspiration-row">
            <div class="col-md-4 col-md-offset-1">
                <div id="splash-inspiration-heading">
                    Never miss an MOT again!
                </div>

                <div id="splash-inspiration-text">
                    MOT Checker provides a simple MOT reminder system via text message and/or email.
                </div>
            </div>

            <!-- Browser Window -->
            <div class="col-md-6" class="splash-browser-window-container">
                <div class="splash-browser-window">
                    {{--<div class="splash-browser-dots-container">--}}
                        {{--<ul class="list-inline splash-browser-dots">--}}
                            {{--<li><i class="fa fa-circle red"></i></li>--}}
                            {{--<li><i class="fa fa-circle yellow"></i></li>--}}
                            {{--<li><i class="fa fa-circle green"></i></li>--}}
                        {{--</ul>--}}
                    {{--</div>--}}
                    <div>
                        <img src="/img/mot-man.jpg" style="width: 100%;">
                    </div>
                </div>
            </div>
        </div>

        <!-- Features Heading -->
        <div class="row">
            <div class="col-md-10 col-md-offset-1 splash-row-heading">
                Personal Accounts
            </div>
        </div>

        <!-- Feature Icons -->
        <div class="row splash-features-icon-row">
            <div class="col-md-10 col-md-offset-1 text-center">
                <div class="col-md-4 splash-features-feature">
                    <div class="splash-feature-icon">
                        <i class="fa fa-car"></i>
                    </div>

                    <div class="splash-feature-heading">
                        Check when your MOT is due
                    </div>

                    <div class="splash-feature-text">
                        It's super simple to check when your MOT or Tax due to expire.
                    </div>
                </div>

                <div class="col-md-4 splash-features-feature">
                    <div class="splash-feature-icon">
                        <i class="fa fa-mobile"></i>
                    </div>

                    <div class="splash-feature-heading">
                        Text Reminders
                    </div>

                    <div class="splash-feature-text">
                        Get text messages reminders when your MOT is due to expire
                    </div>
                </div>

                <div class="col-md-4 splash-features-feature">
                    <div class="splash-feature-icon">
                        <i class="fa fa-envelope-o"></i>
                    </div>

                    <div class="splash-feature-heading">
                        Email Reminder
                    </div>

                    <div class="splash-feature-text">
                        Choose betweem email or text reminders.... or both!
                    </div>
                </div>
            </div>
        </div>

        <!-- Features Heading -->
        <div class="row">
            <div class="col-md-10 col-md-offset-1 splash-row-heading">
                Business Accounts
            </div>
        </div>

        <!-- Feature Icons -->
        <div class="row splash-features-icon-row">
            <div class="col-md-10 col-md-offset-1 text-center">
                <div class="col-md-4 splash-features-feature">
                    <div class="splash-feature-icon">
                        <i class="fa fa-database"></i>
                    </div>

                    <div class="splash-feature-heading">
                        Build your own Database
                    </div>

                    <div class="splash-feature-text">
                       Create your own database of every car that enters your garage.
                    </div>
                </div>

                <div class="col-md-4 splash-features-feature">
                    <div class="splash-feature-icon">
                        <i class="fa fa-refresh"></i>
                    </div>

                    <div class="splash-feature-heading">
                        Auto Refresh
                    </div>

                    <div class="splash-feature-text">
                        Our app syncs with the DVLA every 24 hours so your customer data will always be up to date
                    </div>
                </div>

                <div class="col-md-4 splash-features-feature">
                    <div class="splash-feature-icon">
                        <i class="fa fa-line-chart"></i>
                    </div>

                    <div class="splash-feature-heading">
                        Generate Leads
                    </div>

                    <div class="splash-feature-text">
                        Use our database to generate real sales leads in your local area
                    </div>
                </div>
            </div>
        </div>

        <!-- Features Heading -->
        <div class="row">
            <div class="col-md-10 col-md-offset-1 splash-row-heading">
               Developer API
            </div>
        </div>

        <!-- Feature Icons -->
        <div class="row splash-features-icon-row">
            <div class="col-md-10 col-md-offset-1 text-center">
                <div class="col-md-4 splash-features-feature">
                    <div class="splash-feature-icon">
                        <i class="fa fa-mobile"></i>
                    </div>

                    <div class="splash-feature-heading">
                        Integrate with your app
                    </div>

                    <div class="splash-feature-text">
                        Our JSON API will enable you to simply integrate our lookup service into any app
                    </div>
                </div>

                <div class="col-md-4 splash-features-feature">
                    <div class="splash-feature-icon">
                        <i class="fa fa-money"></i>
                    </div>

                    <div class="splash-feature-heading">
                        Simple Pricing
                    </div>

                    <div class="splash-feature-text">
                        A simple pricing model to suit any budget
                    </div>
                </div>

                <div class="col-md-4 splash-features-feature">
                    <div class="splash-feature-icon">
                        <i class="fa fa-globe"></i>
                    </div>

                    <div class="splash-feature-heading">
                        Web Hooks
                    </div>

                    <div class="splash-feature-text">
                        Our API can post to urls to allow developers to set up custom web hooks
                    </div>
                </div>
            </div>
        </div>

        <!-- Pricing Variables -->
        <?php $plans = Spark::plans()->monthly()->active(); ?>

        <?php
            switch (count($plans)) {
                case 0:
                case 1:
                    $columns = 'col-md-6 col-md-offset-3';
                    break;
                case 2:
                    $columns = 'col-md-6';
                    break;
                case 3:
                    $columns = 'col-md-4';
                    break;
                case 4:
                    $columns = 'col-md-3';
                    break;
                default:
                    throw new Exception("Unsupported number of plans. Please customize view.");
            }
        ?>

        <!-- Pricing Heading -->
        @if (count($plans) > 0)
            <div class="row">
                <div class="col-md-10 col-md-offset-1 splash-row-heading">
                    Simple Pricing
                </div>
            </div>

            <!-- Pricing Table -->
            <div class="row splash-pricing-table-row text-center">
                <div class="col-md-10 col-md-offset-1">
                    @foreach ($plans as $plan)
                        @if ($plan->isActive())
                            <div class="{{ $columns }}">
                                <div class="panel panel-default">
                                    <div class="panel-heading splash-plan-heading">
                                        {{ $plan->name }}
                                    </div>

                                    <div class="panel-body">
                                        <ul class="splash-plan-feature-list">
                                            @foreach ($plan->features as $feature)
                                                <li>{{ $feature }}</li>
                                            @endforeach
                                        </ul>

                                        <hr>

                                        <div class="splash-plan-price">
                                            {{ $plan->currencySymbol }}{{ $plan->price }}
                                        </div>

                                        <div class="splash-plan-interval">
                                            {{ $plan->interval }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>

            <!-- Call To Action Button -->
            <div class="row">
                <div class="col-md-10 col-md-offset-1 text-center">
                    <a href="/register">
                        <button class="btn btn-primary splash-get-started-btn">
                            Get Started!
                        </button>
                    </a>
                </div>
            </div>
        @endif

        <!-- Customers Heading -->
        <div class="row">
            <div class="col-md-10 col-md-offset-1 splash-row-heading">
                <i class="fa fa-comment"></i>&nbsp;What Our Users Say
            </div>
        </div>

        <!-- Customer Testimonials -->
        <div class="row splash-customer-row">
            <div class="col-md-10 col-md-offset-1 text-center">
                <div class="col-md-4 splash-customer">
                    <div class="splash-customer-avatar">
                        <img src="/img/tracy.jpg">
                    </div>

                    <div class="splash-customer-quote">
                        WOW, this is amazing i'll never miss my MOT again!
                    </div>

                    <div class="splash-customer-identity">
                        <div class="splash-customer-name">Tracy Drake</div>
                        <div class="splash-customer-title">Derbyshire</div>
                    </div>
                </div>

                <div class="col-md-4 splash-customer">
                    <div class="splash-customer-avatar">
                        <img src="/img/anna.jpg">
                    </div>

                    <div class="splash-customer-quote">
                        What a good idea, why hasn't anyone does this before?!
                    </div>

                    <div class="splash-customer-identity">
                        <div class="splash-customer-name">Anna Drake</div>
                        <div class="splash-customer-title">Derbyshire</div>
                    </div>
                </div>

                <div class="col-md-4 splash-customer">
                    <div class="splash-customer-avatar">
                        <img src="/img/chris.jpg">
                    </div>

                    <div class="splash-customer-quote">
                        Without a doubt the best app of all time!
                    </div>

                    <div class="splash-customer-identity">
                        <div class="splash-customer-name">Chris Bell</div>
                        <div class="splash-customer-title">(The guy who made the app)</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="row">
            <!-- Company Information -->
            <div class="col-md-10 col-md-offset-1 splash-footer">
                <div class="pull-left splash-footer-company">
                    Copyright © {{ Spark::company() }} - <a href="/terms">Terms Of Service</a>
                </div>

                <!-- Social Icons -->
                {{--<div class="pull-right splash-footer-social-icons">--}}
                    {{--<a href="http://facebook.com">--}}
                        {{--<i class="fa fa-btn fa-facebook-square"></i>--}}
                    {{--</a>--}}
                    {{--<a href="http://twitter.com">--}}
                        {{--<i class="fa fa-btn fa-twitter-square"></i>--}}
                    {{--</a>--}}
                    {{--<a href="http://github.com">--}}
                        {{--<i class="fa fa-github-square"></i>--}}
                    {{--</a>--}}
                {{--</div>--}}

                <div class="clearfix"></div>
            </div>
        </div>
    </div>

    <!-- Footer Scripts -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>
