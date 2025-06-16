<template>
    <section class="main__welcome welcome">
        <div class="welcome__logo"> <img src="/images/logo.png" alt="Название проекта"></div>
        <div class="welcome__head">
            <div class=" welcome__head__items">
                <div class="welcome__head__item">
                    <div class="welcome__head__item__image"> <img src="/images/paper.png" alt="Название проекта">
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
        <div class="welcome__main">
            Заказывайте тексты — система найдет исполнителей и вы получите качественный
            уникальный контент в кратчайшие сроки:
        </div>
        <div class="welcome__statistics">
            <div class="welcome__statistics__image">
                <img src="/images/chart.png" alt="Название проекта">
            </div>
            <div class="welcome__statistics__text">
                <ul class="welcome__statistics__text__items">
                    <li class="welcome__statistics__text__item">Тексты для лендингов</li>
                    <li class="welcome__statistics__text__item">Копирайтинг и рерайтинг</li>
                    <li class="welcome__statistics__text__item">Инфостатьи и новости</li>
                    <li class="welcome__statistics__text__item">SEO-тексты для сайтов</li>
                </ul>
            </div>
        </div>
    </section>
</template>
<style lang="scss">
.welcome {


    &__logo {
    }


    &__head {


        &__items {

        }

        &__item {

            &__image {


                & img {
                    height: 20px;
                }
            }

            &__title {

            }
        }
    }

    &__main {

    }

    &__statistics {


        &__image {
            & img {
                height: 20px;
            }
        }

        &__text {

            // justify-items: center;

            &__items {
                li{list-style: none;}
            }

            &__item {


            }
        }
    }
}
</style>
