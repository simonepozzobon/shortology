<template lang="html">
    <div id="testology-overlay" ref="overlay">
        <div class="top-row"></div>
        <div class="center-row">
            <div class="column left" ref="leftcopy">
                <div class="text">
                    <span class="heading">Scopri l'ultima creazione</span>
                    <span class="sub-heading">di Shortology</span>
                </div>
                <div class="pink-line"></div>
                <div class="buy-on empty"></div>
            </div>
            <div class="column center" ref="image">
                <img src="/wp-content/themes/shortology_new-child/images/overlay/H57_testology.png" alt="">
            </div>
            <div class="column right" ref="rightcopy">
                <div class="text">
                    <span class="call">un grande viaggio nella tua mente</span>
                    <span class="call">per rispondere alla domanda fondamentale: chi sei?</span>
                </div>
                <div class="pink-line"></div>
                <div class="buy-on">
                    <div class="buy">
                        <span>Acquistalo su Amazon</span>
                    </div>
                    <div class="amazon-logo">
                        <a href="https://www.amazon.it/Testology-viaggio-rispondere-domanda-fondamentale/dp/8868742063/ref=sr_1_fkmr0_1?s=books&ie=UTF8&qid=1529397008&sr=1-1-fkmr0&keywords=amazon+testology" target="_blank">
                            <img src="/wp-content/themes/shortology_new-child/images/overlay/amazon.png" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="bottom-row">
            <button class="shortology-btn" @click="hide">Torna al sito</button>
        </div>
    </div>
</template>

<script>
import {TweenMax, TimelineMax} from 'gsap'

export default {
    name: 'Overlay',
    methods: {
        hide: function() {
            var t1 = new TimelineMax()
            t1.to(this.$refs.overlay, .6, {
                display: 'none',
                opacity: 0,
                delay: 0.2
            })
        },
        show: function() {
            var t1 = new TimelineMax()
            t1.to(this.$refs.overlay, .4, {
                display: 'flex',
                opacity: 1,
                delay: 1,
            })
        },
    },
    mounted: function() {
        this.show()
    }
}
</script>

<style lang="scss">
$white: rgb(255,255,255);
$blue: rgb(110, 125, 130);
$pink: rgb(226, 175, 184);

$spacer: 1rem;

#testology-overlay {
    position: fixed;
    top: 0;
    left: 0;
    bottom: 0;
    right: 0;
    background-color: rgba($white, 0.99);
    width: 100%;
    height: 100vh;
    z-index: 1001;
    display: flex;
    flex-direction: column;
    justify-content: space-around;

    display: none;
    opacity: 0;

    > .center-row {
        // height: 33.33333%;
        height: auto;
        display: flex;
        flex-direction: row;

        > .column {
            width: 33.333%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;

            > .text {
                color: $blue;
                display: flex;
                flex-direction: column;
                justify-content: flex-end;
                min-height: 60px;
                padding-bottom: $spacer;


                > span {
                    font-weight: 500;
                }

                > .heading {
                    font-size: 21px;
                    line-height: 1;
                }

                > .sub-heading {
                    font-size: 39px;
                    line-height: 1;
                }

                > .call {
                    font-size: 16px;
                    line-height: 1;

                    @media (max-width: 960px) and (min-width: 830px) {
                        font-size: 14px;
                    }

                    @media (max-width: 829px) and (min-width: 700px) {
                        font-size: 12px;
                    }

                    @media (max-width: 699px) and (min-width: 640px) {
                        font-size: 11px;
                    }
                }

            }

            > .pink-line {
                width: 100%;
                height: 8px;
                background-color: $pink;
            }

            > .buy-on {
                padding-top: $spacer;
                display: flex;
                justify-content: flex-start;

                > .buy {
                    padding-right: $spacer;
                }

                > .amazon-logo {

                    img {
                        width: 100px;
                        height: auto;
                    }
                }

                &.empty {
                    min-height: 30.05px;
                }
            }
        }
    }

    > .top-row {
        height: auto;
    }

    > .bottom-row {
        height: auto;
        display: flex;
        justify-content: center;
        align-items: center;

        > .shortology-btn {
            background-color: $blue;
            color: $white;
            font-size: 24px;
            font-weight: 500;
            padding: 16px 32px;
            border: 0;
        }
    }

    @media (max-width: 640px) {
        > .top-row {
            display: none;
        }

        > .center-row {
            flex-direction: column;
            width: 100%;

            > .column {
                height: 33.3333%;
                width: 100%;

                &.center {
                    img {
                        max-height: 33.3333vh;
                    }
                }
            }
        }
    }
}


// media queries 768 e 480

</style>
