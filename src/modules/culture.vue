<template lang="html">
  <div class="culture">
      <div class="box box-4-col" style="background-image:url(https://placeimg.com/320/420/people/white);">
      </div>
      <div class="box box-4-col hidden-sm-down" style="background-image:url(https://placeimg.com/320/420/people/green);">
      </div>
      <div class="box box-4-col hidden-sm-down" style="background-image:url(https://placeimg.com/320/420/man/grey);">
      </div>
      <div class="box box-6-col" style="background-image:url(https://placeimg.com/320/420/laptop/red);">
      </div>
      <div class="box box-3-col burst">
        <div class="burst-con">
          <h3>Peek Behind the Curtain</h3>
          <a class="btn btn-secondary btn-sm" href="#">Our Process</a>
        </div>
      </div>
      <div class="box box-3-col box-2-row content">
        <div class="content-con">
          <img src="https://placeimg.com/250/400/people/sepia" />
          <h5>2017</h5>
          <h2>Gold</h2>
          <h6>W3 Awards</h6>
          <span class="h6">Client: Sonoma-Cutrer Vineyards</span>
        </div>
      </div>
      <div class="box box-3-col feature">
        <div class="feature-con">
          <div class="feature--img" style="background-image:url(https://placeimg.com/320/420/dog/blue);"></div>
          <span class="jumbo">Otto</span>
          <span class="h3">Dog of the Day</span>
        </div>
      </div>
      <div class="box box-6-col hidden-sm-down" style="background-image:url(https://placeimg.com/320/420/people/sepia);">
      </div>
  </div>
</template>

<script>
export default {
  name: 'culture-block'
}
</script>

<style lang="less">
@import '../utils/variables';
@import '../utils/helper-other';

.culture {
	display: grid;
	grid-gap: 1rem;
	grid-template-columns: repeat(2, 1fr);
	grid-template-rows: repeat(3, 1fr);
	background-image:url(/wp-content/themes/bsm/images/patterns/Confetti-White-BG.svg);
	padding-top:2rem;
	padding-bottom:2rem;
	background-position: 1rem;
	flex-direction: row;
	max-width:1200px;
	margin:auto;

  @media @small {
    grid-template-columns: repeat(12, 1fr);
    grid-template-rows: repeat(3, 1fr);
  }

	.box {
		color: #fff;
		padding: 20px;
		font-size: 150%;
		position: relative;
		display:inline-flex;
		flex-direction: column;
		background-size: cover;
		.hidden-sm-down { display: none; }

		&-6-col {
			grid-column: span 2;
			@media @small {
				grid-column: span 6;
	    }
		}
		&-7-col {
			grid-column: span 2;
			@media @small {
				grid-column: span 7;
	    }
		}
		&-4-col {
			grid-column: span 2;
			@media @small {
				grid-column: span 4;
	    }
		}
		&-3-col {
			grid-column: span 2;
			@media @small {
				grid-column: span 3;
	    }

		}
		&-2-col {
			grid-column: span 2;
			@media @small {
				grid-column: span 2;
	    }

		}&-2-row {
			grid-row: span 2;
			@media @small {
				grid-row: span 2;
	    }
		}

		&.burst {
			padding:0;
			flex-direction: row;

			.burst-con {
				display: inline-flex;
				flex-direction: column;
				justify-content: center;
				margin: auto;

				&:before {
					content:'';
					position: absolute;
					display: block;
					width: 100%;
					height: 100%;
					background-color: @color-lightbulb;
					z-index: -1;
					transform-origin: center;
					transform: scale(.9);
					transition: .25s;
					left: 0;
				}
				&:after {
					content:'';
					position: absolute;
					display: block;
					width: 100%;
					height: 0;
					padding-top: 100%;
					background-color: @color-cobalt;
					transform-origin: center;
					transition-delay: .15s;
					transform: rotate(45deg) scale(1.05);
					transition:.25s;
					z-index: 1;
					left: 0;
					.shadow-1;
				}

				&:hover {
					&:before {
						transform:scale(1);
					}

					&:after {
						transition-delay: .1s;
						transform: rotate(45deg) scale(1.1);
					}
				}

				h3 {
					color: white;
					text-align: center;
					position: relative;
					z-index: 5;
					&:after {
						content: '';
					    display: block;
					    position: relative;
					    bottom: -.5em;
					    border-bottom: .25rem solid @color-lightbulb;
					    width: 5rem;
					    margin: auto;
					}
				}
				a {
					position: relative;
					z-index: 5;
					padding-left:1rem;
					padding-right:1rem;
					white-space: nowrap;
					text-align: center;
				}
			}
		}

		&.content {
			background-color: white;
			.shadow-1;

			.content-con {
				display: flex;
				flex-direction: column;
				color: @color-blackout-dark;
			}

			h2, span.h6 {
				margin:0;
			}

			h6 {
				color: @color-cobalt-dark;
			}
		}
		&.feature {
			display: flex;
			flex-direction: column;
			justify-content: flex-end;

			.feature--img {
				width: 65%;
				height: 0;
				padding-top: 55%;
				border-radius: 100%;
				overflow: hidden;
				border: 0.5em solid  @color-lightbulb;
				background-size: cover;
				float: right;
				position: absolute;
				top: 0;
				right: 0;
				z-index: 10;
			}

			span.jumbo {
				color: @color-blackout-dark;
				margin:0;
				position: relative;
				z-index: 11;
			}

			span.h3 {
				color: @color-cobalt-dark;
				position: relative;
				z-index: 11;
				margin:0;
			}
		}
	}
}
</style>
