<template>
    <section class="main__welcome welcome">
        <div class="welcome__block1">
            <div class="welcome__logo">
                <img src="/images/copywiriting.jpeg" alt="Название проекта">
                <div class="welcome__statistics__text">
                    <ul class="welcome__statistics__text__items">
                        <li class="welcome__statistics__text__item">Тексты для лендингов</li>
                        <li class="welcome__statistics__text__item">Копирайтинг и рерайтинг</li>
                        <li class="welcome__statistics__text__item">Инфостатьи и новости</li>
                        <li class="welcome__statistics__text__item">SEO-тексты для сайтов</li>
                    </ul>
                </div>
            </div>
            <div class="welcome__head">
                <div class=" welcome__head__items">
                    <div class="welcome__head__item">
                        <div class="welcome__head__item__image"> <img src="/images/paper1.png" alt="Название проекта">
                        </div>
                        <div class="welcome__head__item__title">Тексты на заказ</div>
                    </div>
                    <div class="welcome__head__item">
                        <div class="welcome__head__item__image"> <img src="/images/home.png" alt="Название проекта">
                        </div>
                        <div class="welcome__head__item__title">Настоящая работа на дому!</div>
                    </div>
                    <div class="welcome__head__item">
                        <div class="welcome__head__item__image"> <img src="/images/lamp.png" alt="Название проекта">
                        </div>
                        <div class="welcome__head__item__title">Магазин готовых статьей</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="welcome__block2">
            <div class="welcome__main">
                Заказывайте тексты — система найдет исполнителей и вы получите качественный
                уникальный контент в кратчайшие сроки:
            </div>
            <div class="welcome__statistics">
                <div class="welcome__statistics__image">
                    <img src="/images/chart.png" alt="Название проекта">
                </div>
            </div>
        </div>
    </section>
</template>
<style lang="scss">
.welcome {
    @include outerContainer;

    display: grid;
    grid-template-rows: auto;
    grid-auto-flow: row;
    gap: 1rem;

    &__logo {
        margin-top: 40px;
        display: grid;
        justify-self: center;
        & img {
            height: 200px;
        }
    }

    &__head {

        &__items {
            display: grid;
            grid-template-columns: auto;
            grid-auto-flow: column;
            align-items: center;
            gap: 30px;
            justify-content: space-evenly;

            @include mobile {
                grid-auto-flow: row;
                place-items: center;
            }
        }

        &__item {
            @include card;

            display: grid;
            column-gap: 50px;
            grid-template-columns: 1fr 1fr;
            grid-auto-flow: column;
            justify-self: center;
            align-items: center;
            font-size: 16pt;

            &__image {
                display: grid;
                justify-self: end;


                & img {
                    height: 100px;
                }
            }

            &__title {
                display: grid;
                text-align: center;
                justify-self: center;
            }
        }
    }

    &__main {
        padding-top: 80px;
        padding-bottom: 80px;
        font-size: 15pt;
        text-align: center;
    }

    &__statistics {
        display: grid;
        text-align: center;

        &__image {

            & img {

            }
        }

        &__text {
            display: grid;
            // justify-items: center;

            &__items {
                display: grid;
                grid-template-rows: auto;
                grid-auto-flow: row;
                align-items: center;
                li{list-style: none;}
            }

            &__item {


            }
        }
    }
}
</style>
