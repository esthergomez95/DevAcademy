<main class="course-preview">
    <section class="course-preview__video">
        <h1 class="course-preview__title"><?= s($course->name); ?></h1>
        <div class="course-preview__video-player">
            <video controls>
                <source src="/path/to/sample-video.mp4" type="video/mp4">
                Tu navegador no soporta la etiqueta de video.
            </video>
        </div>
    </section>

    <section class="course-preview__info">
        <p class="course-preview__description"><?= s($course->description); ?></p>
    </section>

    <div class="course-preview__actions">
        <a href="/courses" class="course-preview__back-button">Regresar</a>
    </div>
</main>
